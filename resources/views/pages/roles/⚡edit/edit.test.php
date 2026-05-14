<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

describe('UPDATE ROLE WITH PERMISSION', function () {
    beforeEach(function () {
        $permission = Permission::create([
            'name' => 'roles.edit',
            'guard_name' => 'web',
        ]);

        $role = Role::create([
            'name' => 'Président',
            'guard_name' => 'web',
            'unique' => 0,
        ]);

        $role->givePermissionTo($permission);

        $this->user = User::factory()->create();

        $this->user->assignRole($role);

        $this->actingAs($this->user);
    });

    it('verifies if you can update a role', function () {

        $permissions = [];

        $role = Role::create([
            'name' => 'Trésorier',
            'guard_name' => 'web',
            'unique' => 0
        ]);

        Livewire::test('pages.roles.forms.update.form', [
            'role' => $role
        ])->set('form.name', 'Test')
            ->set('form.permissions', $permissions)
            ->call('update');

        assertDatabaseHas('roles', ['name' => 'Test']);
    });
});

describe('UPDATE ROLE WITHOUT PERMISSION', function () {
    beforeEach(function () {
        $role = Role::create([
            'name' => 'Président',
            'guard_name' => 'web',
            'unique' => 0,
        ]);

        $this->user = User::factory()->create();

        $this->user->assignRole($role);

        $this->actingAs($this->user);
    });

    it('verifies if you can’t update a role', function () {

        $permissions = [];

        $role = Role::create([
            'name' => 'Trésorier',
            'guard_name' => 'web',
            'unique' => 0
        ]);

        Livewire::test('pages.roles.forms.update.form', [
            'role' => $role
        ])->set('form.name', 'Test')
            ->set('form.permissions', $permissions)
            ->call('update')
        ->assertForbidden();

        assertDatabaseHas('roles', ['name' => 'Trésorier']);
    });
});

describe('DELETE ROLE WITH PERMISSION', function () {
    beforeEach(function () {
        $permission = Permission::create([
            'name' => 'roles.delete',
            'guard_name' => 'web',
        ]);

        $role = Role::create([
            'name' => 'Président',
            'guard_name' => 'web',
            'unique' => 0,
        ]);

        $role->givePermissionTo($permission);

        $this->user = User::factory()->create();

        $this->user->assignRole($role);

        $this->actingAs($this->user);
    });

    it('verifies if you can’t delete a role and its permissions if the role is assigned to a user', function () {
        $permission = Permission::create([
            'name' => 'test.index',
            'guard_name' => 'web',
        ]);

        $role = Role::create([
            'name' => 'Trésorier',
            'guard_name' => 'web',
            'unique' => 0
        ]);

        $role->givePermissionTo($permission);

        $user = User::factory()->create();
        $user->assignRole($role);

        Livewire::test('pages.roles.forms.update.form', [
            'role' => $role
        ])->call('deleteRole', $role->id);

        assertDatabaseCount('roles', 2);
        assertDatabaseCount('permissions', 2);
    });

    it('verifies if you can delete a role and its permissions if the role is not assigned to a user', function () {
        $permission = Permission::create([
            'name' => 'test.index',
            'guard_name' => 'web',
        ]);

        $role = Role::create([
            'name' => 'Trésorier',
            'guard_name' => 'web',
            'unique' => 0
        ]);

        $role->givePermissionTo($permission);

        Livewire::test('pages.roles.forms.update.form', [
            'role' => $role
        ])->call('deleteRole', $role->id);

        assertDatabaseCount('roles', 1);
        assertDatabaseCount('role_has_permissions', 1);
    });
});

describe('DELETE ROLE WITHOUT PERMISSION', function () {
    beforeEach(function () {
        $role = Role::create([
            'name' => 'Président',
            'guard_name' => 'web',
            'unique' => 0,
        ]);

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    });

    it('verifies if a user without the correct role can’t delete a role', function () {
        $role = Role::create([
            'name' => 'Test',
            'guard_name' => 'web',
            'unique' => 1
        ]);

        Livewire::test('pages.roles.forms.update.form', [
            'role' => $role
        ])->call('deleteRole', $role->id)
            ->assertForbidden();
    });
});
