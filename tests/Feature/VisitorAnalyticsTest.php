<?php

use App\Models\PageView;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);

it('redirects guests from analytics to the private login page', function () {
    $this->get(route('admin.analytics'))
        ->assertRedirect(route('login'));
});

it('returns persisted visitor statistics to authenticated users', function () {
    $admin = User::factory()->create();
    config(['analytics.admin_email' => $admin->email]);
    $this->actingAs($admin);

    DB::table('page_views')->insert([
        [
            'visitor_id' => '00000000-0000-4000-8000-000000000001',
            'page' => 'home',
            'source' => 'Direct',
            'country' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'visitor_id' => '00000000-0000-4000-8000-000000000001',
            'page' => 'projects',
            'source' => 'Direct',
            'country' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'visitor_id' => '00000000-0000-4000-8000-000000000002',
            'page' => 'home',
            'source' => 'example.com',
            'country' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);

    $this->getJson(route('admin.analytics.data', ['period' => 'daily']))
        ->assertOk()
        ->assertJsonPath('visitors', 2)
        ->assertJsonPath('pageViews', 3)
        ->assertJsonPath('locationsAvailable', false)
        ->assertJsonPath('pages.0.page', 'home');
});

it('records a validated portfolio page view and only the referring host', function () {
    $this->postJson(route('analytics.page-views.store'), [
        'visitor_id' => '00000000-0000-4000-8000-000000000001',
        'page' => 'certificates',
        'referrer' => 'https://example.com/article',
    ])
        ->assertNoContent();

    $this->assertDatabaseHas('page_views', [
        'visitor_id' => '00000000-0000-4000-8000-000000000001',
        'page' => 'certificates',
        'source' => 'example.com',
    ]);
});

it('rejects unsupported page names before recording analytics', function () {
    $this->postJson(route('analytics.page-views.store'), [
        'visitor_id' => '00000000-0000-4000-8000-000000000001',
        'page' => 'admin',
    ])->assertUnprocessable();

    expect(PageView::query()->count())->toBe(0);
});

it('requires authentication for analytics data', function () {
    $this->getJson(route('admin.analytics.data'))
        ->assertUnauthorized();
});

it('allows only the configured admin email to sign in', function () {
    $admin = User::factory()->create();
    $otherUser = User::factory()->create();
    config(['analytics.admin_email' => $admin->email]);

    $this->postJson(route('admin.login'), [
        'email' => $otherUser->email,
        'password' => 'password',
    ])->assertUnprocessable();

    $this->postJson(route('admin.login'), [
        'email' => $admin->email,
        'password' => 'password',
    ])->assertOk();
});

it('forbids authenticated users who are not the configured admin', function () {
    config(['analytics.admin_email' => 'admin@example.com']);
    $this->actingAs(User::factory()->create());

    $this->get(route('admin.analytics'))->assertForbidden();
});
