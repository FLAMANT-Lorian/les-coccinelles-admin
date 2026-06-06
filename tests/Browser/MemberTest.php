<?php

use App\Enums\MessageStatus;
use App\Models\Contact;
use App\Models\HallRate;
use App\Models\Message;
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

describe('MEMBERS BROWSER TESTING', function () {
    beforeEach(function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ]);

        $this->seed(PermissionSeeder::class);

        $user = User::factory()->create();
        $this->role = Role::create(['name' => 'admin', 'unique' => 0]);
        $permission = Permission::all();
        $this->role->givePermissionTo($permission);
        $user->assignRole($this->role);

        actingAs($user);
    });

    it('create a member and connect to his account', function () {
        $today = Carbon::now()->translatedFormat('F j, Y');

        visit(route('members.index'))
            ->click('Ajouter un membre')
            ->fill('email', 'test@tests.be')
            ->fill('phone', fake()->phoneNumber)
            ->fill('city', fake()->phoneNumber)
            ->fill('postal_code', fake()->postcode)
            ->click('[title="Sexe"]')
            ->click('Homme')
            ->click('#birth_date')
            ->click('.open [aria-label="' . $today . '"]')
            ->click('[title="Rôle"]')
            ->click('[title="Rôle"] ~ .custom-select span')
            ->click('[title="Statut"]')
            ->click('Actif')
            ->fill('address', fake()->address)
            ->fill('password', 'password1234567890')
            ->click('Créer le profil du membre')
            ->assertSee('test@tests.be')
            ->click('Me deconnecter')
            ->fill('email', 'test@tests.be')
            ->fill('password', 'password1234567890')
            ->click('Me connecter')
            ->assertSee('Tableau de bord');
    });

    it('delete a member', function () {
        visit(route('members.index'))
            ->click('.actions')
            ->click('[data-action] [title="Supprimer le profil du membre"]')
            ->click('.showModal .btn-delete')
            ->assertDontSee(auth()->user()->email);
    });
});
