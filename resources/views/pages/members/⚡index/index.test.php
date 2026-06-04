<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;

describe('VIEW MEMBERS WITH PERMISSIONS', function () {
    beforeEach(function () {
        $permission = Permission::create([
            'name' => 'members.index',
            'guard_name' => 'web',
        ]);

        $role = Role::create([
            'name' => 'member',
            'guard_name' => 'web',
            'unique' => 1
        ]);
        $role->givePermissionTo($permission);
        $user = User::factory()->create();
        $user->assignRole($role);
        $this->actingAs($user);
    });

    it('can access to the member index', function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('members.index', ['locale' => config('app.locale')]))
            ->assertOk();
    });
});

describe('VIEW MEMBERS WITHOUT PERMISSIONS', function () {
    beforeEach(function () {
        $role = Role::create([
            'name' => 'member',
            'guard_name' => 'web',
            'unique' => 1
        ]);
        $user = User::factory()->create();
        $user->assignRole($role);
        $this->actingAs($user);
    });

    it('can’t access to the member index', function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('members.index', ['locale' => config('app.locale')]))
            ->assertForbidden();
    });
});
