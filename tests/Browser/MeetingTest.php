<?php

use App\Models\Meeting;
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

describe('MEETINGS BROWSER TESTING', function () {
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

    it('create a meeting', function () {
        $date_click = Carbon::now()->translatedFormat('F j, Y');

        visit(route('meetings'))
            ->assertSee('Réunions')
            ->click('Planifier une réunion')
            ->fill('address', fake()->address())
            ->click('.date-picker[readonly="readonly"]')
            ->click('[aria-label="' . $date_click . '"]')
            ->fill('hour', Carbon::now()->format('H:i'))
            ->fill('description', fake()->text())
            ->click('Planifier la réunion')
            ->assertSee('1');
    });

    it('delete a meeting', function () {
        $meeting = Meeting::factory()->create();

        visit(route('meetings'))
            ->assertSee('Réunions')
            ->click('.actions')
            ->click('[data-action] [title="Supprimer la réunion"]')
            ->click('.showModal .btn-delete')
            ->assertDontSee($meeting->address);
    });


});
