<?php

use App\Models\HallRate;
use App\Models\User;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

describe('HALL RATES WITH PERMISSIONS', function () {
    beforeEach(function () {
        $permission = Permission::create([
            'name' => 'hallRates.index',
            'guard_name' => 'web',
        ]);

        $this->role = Role::create([
            'name' => 'member',
            'guard_name' => 'web',
            'unique' => 1
        ]);
        $this->role->givePermissionTo($permission);
        $user = User::factory()->create();
        $user->assignRole($this->role);
        $this->actingAs($user);
    });

    it('verifies if a user with the permission can access to the hall rates index', function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('hall-rates', ['locale' => config('app.locale')]))
            ->assertOk();
    });

    it('verifies if a user with the permission can create a hall rate', function () {
        $permission = Permission::create([
            'name' => 'hallRates.create',
            'guard_name' => 'web',
        ]);
        $this->role->givePermissionTo($permission);

        Livewire::test('pages::hall-rates.index')
            ->set('form.type', 'test')
            ->set('form.base_price', 10.5)
            ->set('form.member_price', 10)
            ->call('save')
            ->assertOk();

        assertDatabaseHas('hall_rates', [
            'type' => 'test',
            'base_price' => 1050,
            'member_price' => 1000,
        ]);
    });

    it('verifies if a user with the permission can update a hall rate', function () {
        $permission = Permission::create([
            'name' => 'hallRates.update',
            'guard_name' => 'web',
        ]);
        $this->role->givePermissionTo($permission);

        $hallRate = HallRate::create([
            'type' => 'test',
            'base_price' => 1050,
            'member_price' => 1000,
        ]);

        Livewire::test('pages::hall-rates.index')
            ->set('form.hallRate', $hallRate)
            ->set('form.type', 'New')
            ->set('form.base_price', 10.8)
            ->set('form.member_price', 9.6)
            ->call('update')
            ->assertOk();

        assertDatabaseHas('hall_rates', [
            'type' => 'New',
            'base_price' => 1080,
            'member_price' => 960,
        ]);
    });

    it('verifies if a user with the permission can delete a hall rate', function () {
        $permission = Permission::create([
            'name' => 'hallRates.delete',
            'guard_name' => 'web',
        ]);
        $this->role->givePermissionTo($permission);

        $hallRate = HallRate::create([
            'type' => 'test',
            'base_price' => 1050,
            'member_price' => 1000,
        ]);

        Livewire::test('pages.hall-rates.table.table')
            ->call('deleteHallRate', id: $hallRate->id)
            ->assertOk();

        assertDatabaseCount('hall_rates', 0);
    });
});

describe('HALL RATES WITHOUT PERMISSIONS', function () {
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

    it('verifies if a user with the permission can’t access to the hall rates index', function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('hall-rates', ['locale' => config('app.locale')]))
            ->assertForbidden();
    });

    it('verifies if a user with the permission can’t create a hall rate', function () {
       Livewire::test('pages::hall-rates.index')
            ->set('form.type', 'test')
            ->set('form.base_price', 10.5)
            ->set('form.member_price', 10)
            ->call('save')
            ->assertForbidden();

        assertDatabaseCount('hall_rates', 0);
    });

    it('verifies if a user with the permission can’t update a hall rate', function () {
        $hallRate = HallRate::create([
            'type' => 'test',
            'base_price' => 1050,
            'member_price' => 1000,
        ]);

        Livewire::test('pages::hall-rates.index')
            ->set('form.hallRate', $hallRate)
            ->set('form.type', 'New')
            ->set('form.base_price', 10.8)
            ->set('form.member_price', 9.6)
            ->call('update')
            ->assertForbidden();

        assertDatabaseHas('hall_rates', [
            'type' => 'test',
            'base_price' => 1050,
            'member_price' => 1000,
        ]);
    });

    it('verifies if a user with the permission can’t delete a hall rate', function () {
        $hallRate = HallRate::create([
            'type' => 'test',
            'base_price' => 1050,
            'member_price' => 1000,
        ]);

        Livewire::test('pages.hall-rates.table.table')
            ->call('deleteHallRate', id: $hallRate->id)
            ->assertForbidden();

        assertDatabaseCount('hall_rates', 1);
    });
});
