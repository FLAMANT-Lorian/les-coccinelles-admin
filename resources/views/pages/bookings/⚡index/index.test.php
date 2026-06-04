<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;

describe('BOOKINGS WITH PERMISSIONS', function () {
    beforeEach(function () {
        $permission = Permission::create([
            'name' => 'bookings.index',
            'guard_name' => 'web',
        ]);

        $role = Role::create([
            'name' => 'member',
            'guard_name' => 'web',
            'unique' => 1
        ])->givePermissionTo($permission);

        $user = User::factory()
            ->create()
            ->assignRole($role);

        $this->actingAs($user);
    });

    it('can access to the booking index', function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('bookings.index'))
            ->assertOk();
    });
});

describe('BOOKINGS WITHOUT PERMISSIONS', function () {
    beforeEach(function () {
        $role = Role::create([
            'name' => 'member',
            'guard_name' => 'web',
            'unique' => 1
        ]);

        $user = User::factory()
            ->create()
            ->assignRole($role);

        $this->actingAs($user);
    });

    it('can’t access to the booking index', function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('bookings.index'))
            ->assertForbidden();
    });
});
