<?php

use App\Enums\YesOrNo;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use function Pest\Laravel\assertDatabaseCount;

describe('CREATE ROLE WITH PERMISSIONS', function () {
    beforeEach(function () {
        $permission = Permission::create([
            'name' => 'roles.create',
            'guard_name' => 'web'
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

    it('can create a role with unique name', function () {
        Livewire::test('pages.roles.forms.create.form')
            ->set('form.name', 'Test')
            ->set('form.unique', YesOrNo::YES->value)
            ->call('save')
            ->assertHasErrors(['form.name' => 'unique']);

        assertDatabaseCount('roles', 1);

        Livewire::test('pages.roles.forms.create.form')
            ->set('form.name', 'Test2')
            ->set('form.unique', YesOrNo::YES->value)
            ->call('save')
            ->assertOk();

        assertDatabaseCount('roles', 2);
    });
});

describe('CREATE ROLE WITHOUT PERMISSIONS', function () {
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

    it('can’t create a role with unique name', function () {
        Livewire::test('pages.roles.forms.create.form')
            ->set('form.name', 'Test')
            ->set('form.unique', YesOrNo::YES->value)
            ->call('save')
            ->assertForbidden();
    });
});
