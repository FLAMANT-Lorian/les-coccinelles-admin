<?php

use App\Enums\UtilityCostsStatus;
use App\Models\User;
use App\Models\UtilityCost;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function Pest\Laravel\assertDatabaseCount;
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

        $this->get(route('utility-costs', ['locale' => config('app.locale')]))
            ->assertOk();
    });

    it('verifies if a user with the permission can create an utility cost', function () {
        $permission = Permission::create([
            'name' => 'utilityCosts.create',
            'guard_name' => 'web',
        ]);
        $this->role->givePermissionTo($permission);

        Livewire::test('pages::utility-costs.index')
            ->set('form.type', 'test')
            ->set('form.price', 10.5)
            ->set('form.status', UtilityCostsStatus::outOfDate)
            ->set('form.unit', 'litre')
            ->call('save')
            ->assertOk();

        assertDatabaseHas('utility_costs', [
            'type' => 'test',
            'price' => 1050,
            'status' => UtilityCostsStatus::outOfDate,
            'unit' => 'litre',
        ]);
    });

    it('verifies if a user with the permission can update an utility cost', function () {
        $permission = Permission::create([
            'name' => 'utilityCosts.update',
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
            ->set('form.type', 'New')
            ->set('form.price', 10.8)
            ->set('form.status', UtilityCostsStatus::upToDate)
            ->set('form.unit', 'litre')
            ->call('update')
            ->assertOk();

        assertDatabaseHas('utility_costs', [
            'type' => 'New',
            'price' => 1080,
            'status' => UtilityCostsStatus::upToDate,
            'unit' => 'litre',
        ]);
    });

    it('verifies if a user with the permission can delete an utilityCost', function () {
        $permission = Permission::create([
            'name' => 'utilityCosts.delete',
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
            ->call('deleteUtilityCost', id: $utilityCost->id)
            ->assertOk();

        assertDatabaseCount('utility_costs', 0);
    });
});

describe('UTILITY COSTS WITHOUT PERMISSIONS', function () {
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

    it('verifies if a user with the permission can’t access to the utility cost index', function () {
        $this->get(route('utility-costs', ['locale' => config('app.locale')]))
            ->assertForbidden();
    });

    it('verifies if a user with the permission can’t create an utility cost', function () {
        Livewire::test('pages::utility-costs.index')
            ->set('form.type', 'test')
            ->set('form.price', 10)
            ->set('form.status', UtilityCostsStatus::upToDate)
            ->set('form.unit', 'litre')
            ->call('save')
            ->assertForbidden();

        assertDatabaseCount('utility_costs', 0);
    });

    it('verifies if a user with the permission can’t update an utility cost', function () {
        $utilityCost = UtilityCost::create([
            'type' => 'test',
            'price' => 1050,
            'status' => UtilityCostsStatus::outOfDate,
            'unit' => 'watt',
        ]);

        Livewire::test('pages::utility-costs.index')
            ->set('form.utilityCost', $utilityCost)
            ->set('form.type', 'test')
            ->set('form.price', 10)
            ->set('form.status', UtilityCostsStatus::upToDate)
            ->set('form.unit', 'litre')
            ->call('save')
            ->assertForbidden();

        assertDatabaseHas('utility_costs', [
            'type' => 'test',
            'price' => 1050,
            'status' => UtilityCostsStatus::outOfDate,
            'unit' => 'watt',
        ]);
    });

    it('verifies if a user with the permission can’t delete an utility cost', function () {
        $utilityCost = UtilityCost::create([
            'type' => 'test',
            'price' => 1050,
            'status' => UtilityCostsStatus::outOfDate,
            'unit' => 'watt',
        ]);

        Livewire::test('pages::utility-costs.index')
            ->call('deleteUtilityCost', id: $utilityCost->id)
            ->assertForbidden();

        assertDatabaseCount('utility_costs', 1);
    });
});
