<?php

use App\Models\Meeting;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

describe('MEETINGS WITH PERMISSIONS', function () {
    beforeEach(function () {
        $this->role = Role::create([
            'name' => 'member',
            'guard_name' => 'web',
            'unique' => 1
        ]);
        $user = User::factory()->create();
        $user->assignRole($this->role);
        $this->actingAs($user);
    });

    it('can access to the meetings index', function () {
        $permission = Permission::create([
            'name' => 'meetings.index',
            'guard_name' => 'web',
        ]);
        $this->role->givePermissionTo($permission);

        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('meetings'))
            ->assertOk();
    });

    it('can create a meeting', function () {
        $permission = Permission::create([
            'name' => 'meetings.create',
            'guard_name' => 'web',
        ]);
        $this->role->givePermissionTo($permission);

        Livewire::test('pages::meetings.index')
            ->set('form.address', 'Adresse')
            ->set('form.date', Carbon::now()->format('Y-m-d'))
            ->set('form.hour', Carbon::now()->format('H:i'))
            ->set('form.description', 'Description')
            ->call('save')
            ->assertOk();

        assertDatabaseCount('meetings', 1);
    });

    it('can update a meeting', function () {
        $permission = Permission::create([
            'name' => 'meetings.edit',
            'guard_name' => 'web',
        ]);
        $this->role->givePermissionTo($permission);

        $meeting = Meeting::create([
            'address' => 'Adresse',
            'description' => 'Description',
            'date' => Carbon::now()->format('Y-m-d'),
            'hour' => Carbon::now()->format('H:i'),
        ]);


        Livewire::test('pages::meetings.index')
            ->set('form.meeting', $meeting)
            ->set('form.address', 'Adresse1')
            ->set('form.date', Carbon::now()->format('Y-m-d'))
            ->set('form.hour', Carbon::now()->format('H:i'))
            ->set('form.description', 'Description1')
            ->call('update')
            ->assertOk();

        assertDatabaseHas('meetings', [
            'address' => 'Adresse1',
            'description' => 'Description1',
        ]);
    });

    it('can delete a meeting', function () {
        $permission = Permission::create([
            'name' => 'meetings.delete',
            'guard_name' => 'web',
        ]);
        $this->role->givePermissionTo($permission);

        $meeting = Meeting::create([
            'address' => 'Adresse',
            'description' => 'Description',
            'date' => Carbon::now()->format('Y-m-d'),
            'hour' => Carbon::now()->format('H:i'),
        ]);

        Livewire::test('pages::meetings.index')
            ->call('openModal', modal: 'openDeleteModal', id: $meeting->id)
            ->call('deleteMeeting')
            ->assertOk();

        assertDatabaseCount('meetings', 0);
    });
});

describe('MEETINGS WITHOUT PERMISSIONS', function () {
    beforeEach(function () {
        $this->role = Role::create([
            'name' => 'member',
            'guard_name' => 'web',
            'unique' => 1
        ]);
        $user = User::factory()->create();
        $user->assignRole($this->role);
        $this->actingAs($user);
    });

    it('can’t access to the meetings index', function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('meetings'))
            ->assertForbidden();
    });

    it('can’t create a meeting', function () {
        Livewire::test('pages::meetings.index')
            ->set('form.address', 'Adresse')
            ->set('form.date', Carbon::now()->format('Y-m-d'))
            ->set('form.hour', Carbon::now()->format('H:i'))
            ->set('form.description', 'Description')
            ->call('save')
            ->assertForbidden();

        assertDatabaseCount('meetings', 0);
    });

    it('can’t update a meeting', function () {
        $meeting = Meeting::create([
            'address' => 'Adresse',
            'description' => 'Description',
            'date' => Carbon::now()->format('Y-m-d'),
            'hour' => Carbon::now()->format('H:i'),
        ]);


        Livewire::test('pages::meetings.index')
            ->set('form.meeting', $meeting)
            ->set('form.address', 'Adresse1')
            ->set('form.date', Carbon::now()->format('Y-m-d'))
            ->set('form.hour', Carbon::now()->format('H:i'))
            ->set('form.description', 'Description1')
            ->call('update')
            ->assertForbidden();

        assertDatabaseHas('meetings', [
            'address' => 'Adresse',
            'description' => 'Description',
        ]);
    });

    it('can’t delete a meeting', function () {
        $meeting = Meeting::factory()->create();

        Livewire::test('pages::meetings.index')
            ->call('openModal', modal: 'openDeleteModal', id: $meeting->id)
            ->call('deleteMeeting')
            ->assertForbidden();

        assertDatabaseCount('meetings', 1);
    });
});
