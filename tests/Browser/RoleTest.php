<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;
use function Pest\Laravel\actingAs;

describe('ROLE BROWSER TESTING', function () {
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

    it('create a role and view it in the role list', function () {
        visit(route('roles.index'))
            ->click('Ajouter un rôle')
            ->assertSee('Les champs renseignés avec * sont obligatoires !')
            ->fill('name', 'test')
            ->click('.result-container')
            ->click('Oui')
            ->click('Ajouter le rôle')
            ->assertSee('Répertoire des rôles');
    });

    it('edit a role a remove all permissions to members index', function () {
        visit(route('roles.index'))
            ->click('a[aria-label="' . $this->role->name . '"]')
            ->assertSee($this->role->name)
            ->click('#all_members_selector')
            ->click('Enregistrer les modifications')
            ->assertSee('Répertoire des rôles');

        visit(route('members.index'))
            ->assertSee('403');
    });

    it('delete a role', function () {
        visit(route('roles.index'))
            ->click('a[aria-label="' . $this->role->name . '"]')
            ->assertSee($this->role->name)
            ->click('.btn-delete')
            ->click('.showModal .btn-delete')
            ->assertSee('Répertoire des rôles')
            ->assertDontSee('a[aria-label="' . $this->role->name . '"]');
    });
});
