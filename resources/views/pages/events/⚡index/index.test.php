<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;
use function Pest\Laravel\assertDatabaseCount;

describe('VIEW EVENTS WITH PERMISSIONS', function () {
    beforeEach(function () {
        $permission = Permission::create([
            'name' => 'events.index',
            'guard_name' => 'web',
        ]);

        $this->role = Role::create([
            'name' => 'member',
            'guard_name' => 'web',
            'unique' => 1
        ]);
        $this->role->givePermissionTo($permission);
        $user = User::factory()->create();
        $user->assignRole($this->role);
        $this->actingAs($user);
    });

    it('can access to the events index', function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('events.index'))
            ->assertOk();
    });

    it('can create a new event', function () {
       $permission = Permission::create([
           'name' => 'events.create',
           'guard_name' => 'web'
       ]);

       $this->role->givePermissionTo($permission);

       Livewire::test('pages::events.index')
           ->set('form.name', 'Événement')
           ->set('form.start_date', Carbon::now()->format('Y-m-d'))
           ->set('form.end_date', Carbon::now()->format('Y-m-d'))
           ->set('form.address', 'Chez moi')
           ->set('form.description', 'Description')
           ->call('save')
           ->assertOk();

       assertDatabaseCount('events', 1);
    });
});

describe('VIEW EVENTS WITHOUT PERMISSIONS', function () {
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

    it('can’t access to the event index', function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('events.index'))
            ->assertForbidden();
    });
});
