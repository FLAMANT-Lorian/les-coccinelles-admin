<?php

use App\Enums\MessageStatus;
use App\Models\AvailabilityRequest;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;


describe('AVAILABILITY REQUESTS WITH PERMISSIONS', function () {
    beforeEach(function () {
        $permission = Permission::create([
            'name' => 'availabilities.index',
            'guard_name' => 'web',
        ]);

        $this->role = Role::create([
            'name' => 'Test',
            'guard_name' => 'web',
            'unique' => 1
        ]);

        $this->role->givePermissionTo($permission);
        $this->user = User::factory()->create();
        $this->user->assignRole($this->role);
        $this->actingAs($this->user);
    });

    it('verifies if a user with the permission can access to the availability requests index', function () {
        $this->get(route('availabilities', ['locale' => config('app.locale')]))
            ->assertOk();
    });

    it('verifies if a user with the permission can delete availability requests model', function () {
        $permission = Permission::create([
            'name' => 'availabilities.delete',
            'guard_name' => 'web',
        ]);
        $this->role->givePermissionTo($permission);
        $availability = AvailabilityRequest::factory()->create();

        Livewire::test('pages.availabilities.tables.contact.table')
            ->call('deleteAvailabilityRequest', id: $availability->id)
            ->assertOk();

        assertDatabaseCount('availability_requests', 0);
    });

    it('verifies if a user with the permission can update availability requests model', function () {
        $permission = Permission::create([
            'name' => 'availabilities.update',
            'guard_name' => 'web',
        ]);
        $this->role->givePermissionTo($permission);
        $availability = AvailabilityRequest::factory()->create([
            'status' => MessageStatus::Unread->value
        ]);

        Livewire::test('pages.availabilities.tables.contact.table')
            ->call('markAvailabilityRequestAs', value: MessageStatus::Read->value, id: $availability->id)
            ->assertOk();

        assertDatabaseHas('availability_requests', ['status' => MessageStatus::Read->value]);
    });
});

describe('AVAILABILITY REQUESTS WITHOUT PERMISSIONS', function () {
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

    it('verifies if a user without the permission can’t delete availability requests model', function () {

        $availability = AvailabilityRequest::factory()->create();

        Livewire::test('pages.availabilities.tables.contact.table')
            ->call('deleteAvailabilityRequest', id: $availability->id)
            ->assertForbidden();

        assertDatabaseCount('availability_requests', 1);
    });

    it('verifies if a user without the permission can’t update availability requests model', function () {
        $availability = AvailabilityRequest::factory()->create([
            'status' => MessageStatus::Unread->value
        ]);

        Livewire::test('pages.availabilities.tables.contact.table')
            ->call('markAvailabilityRequestAs', value: MessageStatus::Read->value, id: $availability->id)
            ->assertOk();

        assertDatabaseHas('availability_requests', ['status' => MessageStatus::Unread->value]);
    });
});
