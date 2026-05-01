<?php

use App\Enums\MembersStatus;
use App\Enums\Sex;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

describe('CREATE MEMBER WITH PERMISSION', function () {
    beforeEach(function () {
        $permission = Permission::create([
            'name' => 'members.create',
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

    it('verifies if you can’t create a user without give him a role', function () {

        Livewire::test('pages.members.forms.create.form')
            ->set('form.email', 'test@test.com')
            ->set('form.phone', '0987654321')
            ->set('form.address', 'test')
            ->set('form.postal_code', '4000')
            ->set('form.city', 'Liège')
            ->set('form.status', MembersStatus::active->value)
            ->set('form.sex', Sex::male->value)
            ->set('form.birth_date', '2000-01-01')
            ->set('form.password', 'password')
            ->set('form.role')
            ->call('save')
            ->assertHasErrors(['form.role' => 'required']);
    });
});

describe('CREATE MEMBER WITHOUT PERMISSION', function () {
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

    it('verifies if you can’t access to the create members form if you don’t have thepermission to', function () {
        $this->get(route('members.create', ['locale' => config('app.locale')]))
            ->assertForbidden();
    });
});
