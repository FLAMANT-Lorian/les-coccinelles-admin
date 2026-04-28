<?php

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function Pest\Laravel\assertDatabaseCount;

it('verifies if you can’t delete a role and its permissions if the role is assigned to a user', function () {
    $permission = Permission::create([
        'name' => 'test.index',
        'guard_name' => 'web',
    ]);

    $role = Role::create([
        'name' => 'Président',
        'guard_name' => 'web',
        'unique' => 0
    ]);

    $role->givePermissionTo($permission);

    $user = User::factory()->create();
    $user->assignRole($role);

    Livewire::test('pages.members.role.forms.update.form', [
        'role' => $role
    ])->call('deleteRole', $role->id);

    assertDatabaseCount('roles', 1);
    assertDatabaseCount('permissions', 1);
});

it('verifies if you can delete a role and its permissions if the role is not assigned to a user', function () {
    $permission = Permission::create([
        'name' => 'test.index',
        'guard_name' => 'web',
    ]);

    $role = Role::create([
        'name' => 'Président',
        'guard_name' => 'web',
        'unique' => 0
    ]);

    $role->givePermissionTo($permission);

    Livewire::test('pages.members.role.forms.update.form', [
        'role' => $role
    ])->call('deleteRole', $role->id);

    assertDatabaseCount('roles', 0);
    assertDatabaseCount('role_has_permissions', 0);
});
