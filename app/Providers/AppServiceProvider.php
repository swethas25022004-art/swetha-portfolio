<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('viewAnalytics', function (User $user): bool {
            $adminEmail = config('analytics.admin_email');

            return is_string($adminEmail)
                && $adminEmail !== ''
                && hash_equals(mb_strtolower($adminEmail), mb_strtolower($user->email));
        });
    }
}
