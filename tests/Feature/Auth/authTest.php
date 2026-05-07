<?php

use App\Models\User;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;
use Spatie\Permission\Models\Role;

describe('GUEST USER', function () {
    it('verifies if you are redirected to "/fr" when you try to access to "/" route', function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get('/')
            ->assertRedirect(route('login', ['locale' => config('app.locale')]));
    });

    it('verifies if you are redirected to "/fr/login" when a guest try to access to "/fr/"', function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('dashboard'))
            ->assertRedirect(route('login', ['locale' => config('app.locale')]));
    });

    it('verifies if a a guest can access to "/fr/login"', function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('login', ['locale' => config('app.locale')]))
            ->assertOk();
    });

    it('verifies if a guest user is redirected to login if he is not connected', function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('dashboard'))
            ->assertRedirect(route('login', ['locale' => config('app.locale')]));;
    });
});

describe('CONNECTED USER', function () {
    beforeEach(function () {
        $this->user = User::factory()->create();
        $role = Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
            'unique' => 1
        ]);
        $this->user->assignRole($role);
        $this->actingAs($this->user);
    });

    it('verifies if a authenticated user can access to "/fr/"', function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('dashboard'))
            ->assertOk();
    });
});
