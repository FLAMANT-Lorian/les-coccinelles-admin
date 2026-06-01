<?php

use App\Enums\MessageStatus;
use App\Models\Message;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;
use function Pest\Laravel\actingAs;

describe('MESSAGES BROWSER TESTING', function () {
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

    it('filter messages', function () {
        $unread_message = Message::factory()->create([
            'status' => MessageStatus::Unread->value,
            'email' => 'test@test.be'
        ]);
        $read_message = Message::factory()->create([
            'status' => MessageStatus::Read->value,
            'email' => 'tests@test.be'
        ]);

        visit(route('messages'))
            ->assertSee('Lu')
            ->assertSee('Non lu')
            ->click('.result-container')
            ->click('[data-value="unread"]')
            ->assertSee($unread_message->email)
            ->assertDontSee($read_message->email);
    });

    it('delete a message', function () {
        $message = Message::factory()->create();

        visit(route('messages'))
            ->assertSee($message->email)
            ->click('.actions')
            ->click('[data-action] [title="Supprimer le message"]')
            ->click('.showModal .btn-delete')
            ->assertDontSee($message->email);

    });

});
