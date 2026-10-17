<?php

namespace App\Http\Controllers;

use App\Models\PageView;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RecordPageViewController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'visitor_id' => ['required', 'uuid'],
            'page' => ['required', 'in:home,projects,certificates,contact'],
            'referrer' => ['nullable', 'url', 'max:2048'],
        ]);

        if ($request->user() !== null) {
            return response()->json([], 204);
        }

        $referrer = $validated['referrer'] ?? null;
        $sourceHost = is_string($referrer) ? parse_url($referrer, PHP_URL_HOST) : null;
        $source = is_string($sourceHost) && strtolower($sourceHost) !== strtolower($request->getHost())
            ? strtolower($sourceHost)
            : 'Direct';

        PageView::create([
            'visitor_id' => $validated['visitor_id'],
            'page' => $validated['page'],
            'source' => $source,
        ]);

        return response()->json([], 204);
    }
}
