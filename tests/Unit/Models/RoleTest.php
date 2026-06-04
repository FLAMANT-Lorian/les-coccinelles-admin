<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

it('verifies if you can create a multiple role with permissions and give the role to different users', function () {

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

    expect($user->roles()->first()->name)->toBe($role->name)
        ->and($role->users()->first()->first_name)->toBe($user->first_name)
        ->and($user->roles()->first()->permissions()->first()->name)->toBe($role->permissions()->first()->name);
});
