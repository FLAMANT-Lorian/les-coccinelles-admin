<?php

use App\Models\Role;
use App\Models\User;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;
use function Pest\Laravel\actingAs;

describe('AUTH BROWSER TESTING', function () {
    beforeEach(function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ]);
    });

    it('tests login and logout form', closure: function () {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'admin', 'unique' => 1]);
        $user->assignRole($role);

        visit(route('login'))
            ->fill('email', $user->email)
            ->fill('password', 'password')
            ->click('Me connecter')
            ->assertSee('Tableau de bord')
            ->click('Me deconnecter')
            ->assertSee('Me connecter');

        actingAs($user);

        visit(route('dashboard'))
            ->assertSee('Tableau de bord')
            ->click('Me deconnecter')
            ->assertSee('Me connecter');
    });
});
