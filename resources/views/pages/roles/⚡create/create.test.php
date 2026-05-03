<?php

use App\Enums\YesOrNo;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
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

    it('verifies if you can create a role with unique name', function () {
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

    it('verifies if you can’t create a role with unique name', function () {
        Livewire::test('pages.roles.forms.create.form')
            ->set('form.name', 'Test')
            ->set('form.unique', YesOrNo::YES->value)
            ->call('save')
            ->assertForbidden();
    });
});
