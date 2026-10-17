<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

it('requires an admin email before creating the analytics account', function () {
    config(['analytics.admin_email' => null]);

    $this->artisan('analytics:create-admin')
        ->expectsOutputToContain('ANALYTICS_ADMIN_EMAIL')
        ->assertExitCode(1);

    expect(User::query()->count())->toBe(0);
});

it('creates the configured admin with a hashed password', function () {
    config(['analytics.admin_email' => 'admin@example.com']);

    $this->artisan('analytics:create-admin', ['--name' => 'Portfolio Admin'])
        ->expectsQuestion('Password (minimum 12 characters)', 'a-long-private-password')
        ->expectsQuestion('Confirm password', 'a-long-private-password')
        ->expectsOutputToContain('Analytics admin account created')
        ->assertSuccessful();

    $admin = User::query()->where('email', 'admin@example.com')->firstOrFail();

    expect($admin->name)->toBe('Portfolio Admin');
    expect(Hash::check('a-long-private-password', $admin->password))->toBeTrue();
});

it('rejects short or mismatched passwords without creating an account', function () {
    config(['analytics.admin_email' => 'admin@example.com']);

    $this->artisan('analytics:create-admin', ['--name' => 'Portfolio Admin'])
        ->expectsQuestion('Password (minimum 12 characters)', 'short')
        ->expectsQuestion('Confirm password', 'different')
        ->expectsOutputToContain('matching passwords with at least 12 characters')
        ->assertExitCode(1);

    expect(User::query()->count())->toBe(0);
});

it('does not overwrite an existing admin account', function () {
    config(['analytics.admin_email' => 'admin@example.com']);
    $admin = User::factory()->create(['email' => 'admin@example.com']);
    $originalPassword = $admin->password;

    $this->artisan('analytics:create-admin')
        ->expectsOutputToContain('An account already exists')
        ->assertExitCode(1);

    expect($admin->fresh()->password)->toBe($originalPassword);
});
