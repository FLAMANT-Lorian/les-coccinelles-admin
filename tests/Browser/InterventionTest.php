<?php

use App\Models\Intervention;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\PermissionSeeder;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

describe('INTERVENTIONS BROWSER TESTING', function () {
    beforeEach(function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ]);

        $this->seed(PermissionSeeder::class);

        $user = User::factory()->create();
        $this->role = Role::create(['name' => 'admin', 'unique' => 1]);
        $permission = Permission::all();
        $this->role->givePermissionTo($permission);
        $user->assignRole($this->role);

        actingAs($user);
    });

    it('create an intervention', function () {

        $deadline = Carbon::now()->translatedFormat('F j, Y');

        $user = User::factory()->create();

        visit(route('interventions'))
            ->click('Ajouter une intervention')
            ->fill('name', 'Toto')
            ->click('[aria-label="Personne assignée"]')
            ->click($user->full_name)
            ->click('[aria-label="Statut"]')
            ->click('[aria-label="Statut"] ~ .custom-select button:first-of-type')
            ->click('#deadline ~ input')
            ->click('.open [aria-label="' . $deadline . '"]')
            ->click('Ajouter l’intervention')
            ->assertSee('Toto');

        assertDatabaseCount('interventions', 1);
    });

    it('update an intervention', function () {

        $deadline = Carbon::now()->translatedFormat('F j, Y');

        $intervention = Intervention::factory()
            ->assignedTo(auth()->user())
            ->create();

        visit(route('interventions'))
            ->assertSee($intervention->name)
            ->click('.actions')
            ->click('.actions-table [title="Modifier l’intervention"]')
            ->fill('name', 'Toto')
            ->click('.showModal form button[type="submit"]')
            ->assertSee('Toto');

        assertDatabaseHas('interventions', [
            'name' => 'Toto'
        ]);
    });

    it('delete an intervention', function () {
        $intervention = Intervention::factory()
            ->assignedTo(auth()->user())
            ->create();

        visit(route('interventions'))
            ->assertSee('Interventions')
            ->click('.actions')
            ->click('[data-action] [title="Supprimer l’intervention"]')
            ->click('.showModal .btn-delete')
            ->assertDontSee($intervention->name);

        assertDatabaseCount('interventions', 0);
    });

});
