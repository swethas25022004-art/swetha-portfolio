<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageView;
use Carbon\CarbonInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class AnalyticsController extends Controller
{
    public function index(): View
    {
        return view('welcome');
    }

    public function data(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'period' => ['sometimes', 'in:daily,weekly,monthly'],
        ]);

        $period = $validated['period'] ?? 'daily';
        $today = now()->startOfDay();
        $bucketCount = match ($period) {
            'weekly' => 8,
            'monthly' => 12,
            default => 7,
        };
        $startDate = match ($period) {
            'weekly' => $today->copy()->startOfWeek()->subWeeks($bucketCount - 1),
            'monthly' => $today->copy()->startOfMonth()->subMonths($bucketCount - 1),
            default => $today->copy()->subDays($bucketCount - 1),
        };
        $endDate = $today->copy()->endOfDay();

        $views = PageView::query()
            ->whereBetween('created_at', [$startDate, $endDate]);

        $dailyTotals = (clone $views)
            ->selectRaw('DATE(created_at) as day, COUNT(*) as views, COUNT(DISTINCT visitor_id) as visitors')
            ->groupBy('day')
            ->orderBy('day')
            ->get()
            ->keyBy('day');

        $series = $this->buildSeries($dailyTotals, $period, $startDate, $today, $bucketCount);
        $locations = (clone $views)
            ->whereNotNull('country')
            ->selectRaw('country, COUNT(DISTINCT visitor_id) as visitors')
            ->groupBy('country')
            ->orderByDesc('visitors')
            ->limit(5)
            ->get();

        return response()->json([
            'period' => $period,
            'visitors' => (clone $views)->distinct()->count('visitor_id'),
            'pageViews' => (clone $views)->count(),
            'locationCount' => (clone $views)->whereNotNull('country')->distinct()->count('country'),
            'locations' => $locations,
            'locationsAvailable' => $locations->isNotEmpty(),
            'series' => $series,
            'pages' => (clone $views)
                ->selectRaw('page, COUNT(*) as views')
                ->groupBy('page')
                ->orderByDesc('views')
                ->get(),
            'sources' => (clone $views)
                ->whereNotNull('source')
                ->selectRaw('source, COUNT(*) as views')
                ->groupBy('source')
                ->orderByDesc('views')
                ->limit(5)
                ->get(),
        ]);
    }

    /**
     * @param  Collection<string, object>  $dailyTotals
     * @return array<int, array{label: string, views: int, visitors: int}>
     */
    private function buildSeries(
        Collection $dailyTotals,
        string $period,
        CarbonInterface $startDate,
        CarbonInterface $today,
        int $bucketCount,
    ): array {
        $series = [];

        for ($index = 0; $index < $bucketCount; $index++) {
            $bucketStart = match ($period) {
                'weekly' => $startDate->copy()->addWeeks($index),
                'monthly' => $startDate->copy()->addMonths($index),
                default => $startDate->copy()->addDays($index),
            };
            $bucketEnd = match ($period) {
                'weekly' => $bucketStart->copy()->endOfWeek()->min($today->copy()->endOfDay()),
                'monthly' => $bucketStart->copy()->endOfMonth()->min($today->copy()->endOfDay()),
                default => $bucketStart->copy()->endOfDay(),
            };
            $bucketTotals = $dailyTotals->filter(function (object $row) use ($bucketStart, $bucketEnd): bool {
                return $row->day >= $bucketStart->toDateString()
                    && $row->day <= $bucketEnd->toDateString();
            });

            $series[] = [
                'label' => match ($period) {
                    'weekly' => $bucketStart->format('M j'),
                    'monthly' => $bucketStart->format('M'),
                    default => $bucketStart->format('D'),
                },
                'views' => (int) $bucketTotals->sum('views'),
                'visitors' => (int) $bucketTotals->sum('visitors'),
            ];
        }

        return $series;
    }
}
