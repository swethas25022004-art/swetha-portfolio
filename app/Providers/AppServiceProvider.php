<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Gate::define('viewAnalytics', function (User $user): bool {
            $adminEmail = config('analytics.admin_email');

            return is_string($adminEmail)
                && $adminEmail !== ''
                && hash_equals(
                    mb_strtolower($adminEmail),
                    mb_strtolower($user->email)
                );
        });
    }
}