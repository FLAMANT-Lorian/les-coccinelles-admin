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
use function Pest\Laravel\assertDatabaseHas;

describe('SETTINGS BROWSER TESTING', function () {
    beforeEach(function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ]);

        $this->seed(PermissionSeeder::class);

        $user = User::factory()->create([
            'email' => 'test@test.be'
        ]);
        $this->role = Role::create(['name' => 'admin', 'unique' => 1]);
        $permission = Permission::all();
        $this->role->givePermissionTo($permission);
        $user->assignRole($this->role);

        actingAs($user);
    });

    it('change his email', function () {
        visit(route('settings'))
            ->fill('email', 'test@example.com')
            ->click('Enregistrer les modifications')
            ->wait(0.1);

        assertDatabaseHas('users', [
            'email' => 'test@example.com'
        ]);
    });
});
