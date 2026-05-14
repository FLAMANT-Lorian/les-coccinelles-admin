<?php

use App\Enums\UtilityCostsStatus;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UtilityCost;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;
use function Pest\Laravel\assertDatabaseHas;

describe('UTILITY COST WITH PERMISSIONS', function () {
    beforeEach(function () {
        $this->role = Role::create([
            'name' => 'member',
            'guard_name' => 'web',
            'unique' => 1
        ]);
        $user = User::factory()->create();
        $user->assignRole($this->role);
        $this->actingAs($user);
    });

    it('verifies if a user with the permission can access to the utility cost index', function () {
        $permission = Permission::create([
            'name' => 'utilityCosts.index',
            'guard_name' => 'web',
        ]);
        $this->role->givePermissionTo($permission);

        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('utility-costs'))
            ->assertOk();
    });

    it('verifies if a user with the permission can update an utility cost', function () {
        $permission = Permission::create([
            'name' => 'utilityCosts.edit',
            'guard_name' => 'web',
        ]);
        $this->role->givePermissionTo($permission);

        $utilityCost = UtilityCost::create([
            'type' => 'test',
            'price' => 1050,
            'status' => UtilityCostsStatus::outOfDate,
            'unit' => 'watt',
        ]);

        Livewire::test('pages::utility-costs.index')
            ->set('form.utilityCost', $utilityCost)
            ->set('form.price', 10.8)
            ->set('form.status', UtilityCostsStatus::upToDate)
            ->call('update')
            ->assertOk();

        assertDatabaseHas('utility_costs', [
            'price' => 1080,
            'status' => UtilityCostsStatus::upToDate,
        ]);
    });
});

describe('UTILITY COSTS WITHOUT PERMISSIONS', function () {
    beforeEach(function () {
        Permission::create([
            'name' => 'utilityCosts.index',
            'guard_name' => 'web',
        ]);

        $role = Role::create([
            'name' => 'member',
            'guard_name' => 'web',
            'unique' => 1
        ]);
        $user = User::factory()->create();
        $user->assignRole($role);
        $this->actingAs($user);
    });

    it('verifies if a user without the permission can’t access to the utility cost index', function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('utility-costs'))
            ->assertForbidden();
    });

    it('verifies if a user without the permission can’t update an utility cost', function () {
        $utilityCost = UtilityCost::create([
            'type' => 'test',
            'price' => 1050,
            'status' => UtilityCostsStatus::outOfDate,
            'unit' => 'watt',
        ]);

        Livewire::test('pages::utility-costs.index')
            ->set('form.utilityCost', $utilityCost)
            ->set('form.price', 10)
            ->set('form.status', UtilityCostsStatus::upToDate)
            ->call('update')
            ->assertForbidden();

        assertDatabaseHas('utility_costs', [
            'price' => 1050,
            'status' => UtilityCostsStatus::outOfDate,
        ]);
    });
});
