<?php

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


describe('VIEW AVAILABILITY REQUESTS WITH PERMISSIONS', function () {
    beforeEach(function () {
        $permission = Permission::create([
            'name' => 'availabilities.index',
            'guard_name' => 'web',
        ]);

        $role = Role::create([
            'name' => 'Test',
            'guard_name' => 'web',
            'unique' => 1
        ]);

        $role->givePermissionTo($permission);
        $this->user = User::factory()->create();
        $this->user->assignRole($role);
        $this->actingAs($this->user);
    });

    it('verifies if a user with the permission can access to the availability requests index', function () {
        $this->get(route('availabilities', ['locale' => config('app.locale')]))
            ->assertOk();
    });
});

describe('VIEW AVAILABILITY REQUESTS WITHOUT PERMISSIONS', function () {
    beforeEach(function () {
        $role = Role::create([
            'name' => 'Test',
            'guard_name' => 'web',
            'unique' => 1
        ]);

        $this->user = User::factory()->create();

        $this->user->assignRole($role);

        $this->actingAs($this->user);
    });

    it('verifies if a user without the permission can’t access to the availability requests index', function () {
        $this->get(route('availabilities', ['locale' => config('app.locale')]))
            ->assertForbidden();
    });
});
