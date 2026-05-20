<?php

use App\Enums\InterventionStatus;
use App\Models\Intervention;
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

describe('INTERVENTIONS WITH PERMISSIONS', function () {
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

    it('verifies if a user with the permission can access to the intervention index', function () {
        $permission = Permission::create([
            'name' => 'interventions.index',
            'guard_name' => 'web',
        ]);
        $this->role->givePermissionTo($permission);

        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('interventions'))
            ->assertOk();
    });

    it('verifies if a user with the permission can create an intervention', function () {
        $permission = Permission::create([
            'name' => 'interventions.create',
            'guard_name' => 'web',
        ]);
        $this->role->givePermissionTo($permission);

        Livewire::test('pages::interventions.index')
            ->set('form.name', 'test')
            ->set('form.description', 'test')
            ->set('form.status', InterventionStatus::todo->value)
            ->set('form.assignee', auth()->user()->id)
            ->set('form.deadline', Carbon::now()->addDays(10))
            ->call('save')
            ->assertOk();

        assertDatabaseCount('interventions', 1);
    });

    it('verifies if a user with the permission can update an intervention', function () {
        $permission = Permission::create([
            'name' => 'interventions.edit',
            'guard_name' => 'web',
        ]);
        $this->role->givePermissionTo($permission);

        $intervention = Intervention::create([
            'name' => 'test1',
            'description' => 'test1',
            'deadline' => Carbon::now()->addDays(10),
            'status' => InterventionStatus::todo->value,
        ]);

        Livewire::test('pages::interventions.index')
            ->set('form.intervention', $intervention)
            ->set('form.name', 'test2')
            ->set('form.description', 'test2')
            ->set('form.status', InterventionStatus::done->value)
            ->set('form.assignee', auth()->user()->id)
            ->set('form.deadline', Carbon::now()->addDays(5))
            ->call('update')
            ->assertOk();

        assertDatabaseHas('interventions', [
            'name' => 'test2',
            'description' => 'test2',
            'status' => InterventionStatus::done->value,
            'deadline' => Carbon::now()->addDays(5),
            'assigned_to' => auth()->user()->id,
            'created_by' => auth()->user()->id,
        ]);
    });

    it('verifies if a user with the permission can delete an intervention', function () {
        $permission = Permission::create([
            'name' => 'interventions.delete',
            'guard_name' => 'web',
        ]);
        $this->role->givePermissionTo($permission);

        $intervention = Intervention::create([
            'name' => 'test1',
            'description' => 'test1',
            'deadline' => Carbon::now()->addDays(10),
            'status' => InterventionStatus::todo->value,
        ]);

        Livewire::test('pages::interventions.index')
            ->call('openModal', modal: 'openDeleteModal', id: $intervention->id)
            ->call('deleteIntervention')
            ->assertOk();

        assertDatabaseCount('interventions', 0);
    });
});

describe('INTERVENTIONS WITHOUT PERMISSIONS', function () {
    beforeEach(function () {
        Permission::create([
            'name' => 'interventions.index',
            'guard_name' => 'web',
        ]);

        $role = Role::create([
            'name' => 'member',
            'guard_name' => 'web',
            'unique' => 1
        ]);
        $user = User::factory()->create();
        $user->assignRole($role);
        $this->actingAs($user);
    });

    it('verifies if a user without the permission can’t access to the intervention index', function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('interventions'))
            ->assertForbidden();
    });

    it('verifies if a user without the permission can’t create an intervention', function () {
        Livewire::test('pages::interventions.index')
            ->set('form.name', 'test2')
            ->set('form.description', 'test2')
            ->set('form.status', InterventionStatus::done->value)
            ->set('form.assignee', auth()->user()->id)
            ->set('form.deadline', Carbon::now()->addDays(5))
            ->call('save')
            ->assertForbidden();

        assertDatabaseCount('interventions', 0);
    });

    it('verifies if a user without the permission can’t update an intervention', function () {
        $intervention = Intervention::create([
            'name' => 'test1',
            'description' => 'test1',
            'deadline' => Carbon::now()->addDays(10)->format('Y-m-d'),
            'status' => InterventionStatus::todo->value,
        ]);

        Livewire::test('pages::interventions.index')
            ->set('form.intervention', $intervention)
            ->set('form.name', 'test2')
            ->set('form.description', 'test2')
            ->set('form.status', InterventionStatus::done->value)
            ->set('form.assignee', auth()->user()->id)
            ->set('form.deadline', Carbon::now()->addDays(5)->format('Y-m-d'))
            ->call('update')
            ->assertForbidden();

        assertDatabaseHas('interventions', [
            'name' => 'test1',
            'description' => 'test1',
            'status' => InterventionStatus::todo->value,
            'deadline' => Carbon::parse($intervention->deadline)->format('Y-m-d H:i:s'),
        ]);
    });

    it('verifies if a user without the permission can’t delete an intervention', function () {
        $intervention = Intervention::create([
            'name' => 'test1',
            'description' => 'test1',
            'deadline' => Carbon::now()->addDays(10),
            'status' => InterventionStatus::todo->value,
        ]);

        Livewire::test('pages::interventions.index')
            ->call('openModal', modal: 'openDeleteModal', id: $intervention->id)
            ->call('deleteIntervention')
            ->assertForbidden();

        assertDatabaseCount('interventions', 1);
    });
});
