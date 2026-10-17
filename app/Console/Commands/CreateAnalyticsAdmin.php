<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('analytics:create-admin {--name=}')]
#[Description('Create the configured analytics administrator account')]
class CreateAnalyticsAdmin extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $adminEmail = config('analytics.admin_email');

        if (! is_string($adminEmail) || trim($adminEmail) === '') {
            $this->components->error('Set ANALYTICS_ADMIN_EMAIL in your .env file before creating the admin account.');

            return self::FAILURE;
        }

        $adminEmail = trim($adminEmail);

        if (User::query()->where('email', $adminEmail)->exists()) {
            $this->components->error('An account already exists for the configured admin email.');

            return self::FAILURE;
        }

        $name = trim((string) ($this->option('name') ?: $this->ask('Admin name')));
        $password = (string) $this->secret('Password (minimum 12 characters)');
        $passwordConfirmation = (string) $this->secret('Confirm password');

        if ($name === '' || mb_strlen($password) < 12 || $password !== $passwordConfirmation) {
            $this->components->error('Provide a name and matching passwords with at least 12 characters.');

            return self::FAILURE;
        }

        User::query()->create([
            'name' => $name,
            'email' => $adminEmail,
            'password' => $password,
            'email_verified_at' => now(),
        ]);

        $this->components->info('Analytics admin account created. Sign in at /admin/login.');

        return self::SUCCESS;
    }
}
