<?php

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

    it('verifies if a user with the permission can access to the member index', function () {
        $this->get(route('members.index', ['locale' => config('app.locale')]))
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

    it('verifies if a user with the permission can access to the member index', function () {
        $this->get(route('members.index', ['locale' => config('app.locale')]))
            ->assertForbidden();
    });
});
