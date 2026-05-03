<?php

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


describe('VIEW MESSAGES WITH PERMISSIONS', function () {
    beforeEach(function () {
        $permission = Permission::create([
            'name' => 'messages.index',
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

    it('verifies if a user with the permission can access to the message index', function () {
        $this->get(route('messages', ['locale' => config('app.locale')]))
            ->assertOk();
    });
});

describe('VIEW MESSAGES WITHOUT PERMISSIONS', function () {
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

    it('verifies if a user without the permission can’t access to the message index', function () {
        $this->get(route('messages', ['locale' => config('app.locale')]))
            ->assertForbidden();
    });
});
