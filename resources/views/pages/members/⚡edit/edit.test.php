<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use function Pest\Laravel\assertDatabaseCount;

describe('UPDATE MEMBERS WITH PERMISSIONS', function () {
    beforeEach(function () {
        $permissions = Permission::create([
            'name' => 'members.edit',
            'guard_name' => 'web'
        ]);

        $role = Role::create([
            'name' => 'Test',
            'guard_name' => 'web',
            'unique' => 1
        ]);

        $role->givePermissionTo($permissions);
        $this->user = User::factory()->create();
        $this->user->assignRole($role);
        $this->actingAs($this->user);
    });

    it('verifies if you can update a member because you have the right permission', function () {

        Livewire::test('pages.members.forms.update.form', [
            'member' => $this->user
        ])
            ->set('form.first_name', 'Test')
            ->call('update');

        $this->assertDatabaseHas('users', [
            'first_name' => 'Test',
        ]);
    });
});

describe('UPDATE MEMBERS WITHOUT PERMISSIONS', function () {
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

    it('verifies if you can’t update a member if you don’t have the permissions', function () {

        Livewire::test('pages.members.forms.update.form', [
            'member' => $this->user
        ])->set('form.first_name', 'Test')
            ->call('update')
            ->assertForbidden();

        $this->assertDatabaseHas('users', [
            'first_name' => $this->user->first_name,
        ]);
    });
});

describe('DELETE MEMBER WITH PERMISSIONS', function () {
    beforeEach(function () {
        $permissions = Permission::create([
            'name' => 'members.delete',
            'guard_name' => 'web'
        ]);

        $this->role = Role::create([
            'name' => 'Test',
            'guard_name' => 'web',
            'unique' => 0
        ]);

        $this->role->givePermissionTo($permissions);
        $this->user = User::factory()->create();
        $this->user->assignRole($this->role);
        $this->actingAs($this->user);
    });

    it('verifies if a user can delete a member', function () {
        $member = User::factory()->create();
        $member->assignRole($this->role);
        Livewire::test('pages.members.forms.update.form', [
            'member' => $member
        ])->call('deleteMember', $member->id);

        assertDatabaseCount('users', 1);
    });
});

describe('DELETE MEMBER WITHOUT PERMISSIONS', function () {
    beforeEach(function () {
        $this->role = Role::create([
            'name' => 'Test',
            'guard_name' => 'web',
            'unique' => 0
        ]);

        $this->user = User::factory()->create();
        $this->user->assignRole($this->role);
        $this->actingAs($this->user);
    });

    it('verifies if a user can delete a member', function () {
        $member = User::factory()->create();
        $member->assignRole($this->role);
        Livewire::test('pages.members.forms.update.form', [
            'member' => $member
        ])->call('deleteMember', $member->id)
        ->assertForbidden();

        assertDatabaseCount('users', 2);
    });
});
