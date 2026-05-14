<?php

use App\Enums\YesOrNo;
use App\Models\Contact;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

describe('CONTACTS WITH PERMISSIONS', function () {
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

    it('verifies if a user with the permission can access to the contacts index', function () {
        $permission = Permission::create([
            'name' => 'contacts.index',
            'guard_name' => 'web',
        ]);
        $this->role->givePermissionTo($permission);

        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('contacts'))
            ->assertOk();
    });

    it('verifies if a user with the permission can create a contact', function () {
        $permission = Permission::create([
            'name' => 'contacts.create',
            'guard_name' => 'web',
        ]);
        $this->role->givePermissionTo($permission);

        Livewire::test('pages::contacts.index')
            ->set('form.last_name', 'Flamant')
            ->set('form.first_name', 'Lorian')
            ->set('form.email', 'test@test.be')
            ->set('form.phone', '+XX XXX XX XX XX')
            ->set('form.member_card', YesOrNo::YES->value)
            ->set('form.address', 'Rue de test')
            ->call('save')
            ->assertOk();

        assertDatabaseCount('contacts', 1);
    });

    it('verifies if a user with the permission can update a contact', function () {
        $permission = Permission::create([
            'name' => 'contacts.edit',
            'guard_name' => 'web',
        ]);
        $this->role->givePermissionTo($permission);

        $contact = Contact::factory()->create();

        Livewire::test('pages::contacts.index')
            ->set('form.contact', $contact)
            ->set('form.last_name', 'Flamant')
            ->set('form.first_name', 'Lorian')
            ->set('form.email', 'test@test.be')
            ->set('form.phone', '+XX XXX XX XX XX')
            ->set('form.member_card', YesOrNo::YES->value)
            ->set('form.address', 'Rue de test')
            ->call('update')
            ->assertOk();

        assertDatabaseHas('contacts', [
            'first_name' => 'Lorian',
            'last_name' => 'Flamant',
            'email' => 'test@test.be',
            'telephone' => '+XX XXX XX XX XX',
            'member_card' => 1,
            'address' => 'Rue de test'
        ]);
    });

    it('verifies if a user with the permission can delete a contact', function () {
        $permission = Permission::create([
            'name' => 'contacts.delete',
            'guard_name' => 'web',
        ]);
        $this->role->givePermissionTo($permission);

        $contact = Contact::factory()->create();

        Livewire::test('pages::contacts.index')
            ->call('openModal', modal: 'openDeleteModal', id: $contact->id)
            ->call('delete')
            ->assertOk();

        assertDatabaseCount('contacts', 0);
    });
});

describe('CONTACTS WITHOUT PERMISSIONS', function () {
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

    it('verifies if a user without the permission can’t access to the contacts index', function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('contacts'))
            ->assertForbidden();
    });

    it('verifies if a user with the permission can’t create a contact', function () {
        Livewire::test('pages::contacts.index')
            ->set('form.last_name', 'Flamant')
            ->set('form.first_name', 'Lorian')
            ->set('form.email', 'test@test.be')
            ->set('form.phone', '+XX XXX XX XX XX')
            ->set('form.member_card', YesOrNo::YES->value)
            ->set('form.address', 'Rue de test')
            ->call('save')
            ->assertForbidden();

        assertDatabaseCount('contacts', 0);
    });

    it('verifies if a user without the permission can’t update a contact', function () {
        $contact = Contact::factory()->create();

        Livewire::test('pages::contacts.index')
            ->set('form.contact', $contact)
            ->set('form.last_name', 'Flamant')
            ->set('form.first_name', 'Lorian')
            ->set('form.email', 'test@test.be')
            ->set('form.phone', '+XX XXX XX XX XX')
            ->set('form.member_card', YesOrNo::YES->value)
            ->set('form.address', 'Rue de test')
            ->call('update')
            ->assertForbidden();

        assertDatabaseHas('contacts', [
            'last_name' => $contact->last_name,
            'first_name' => $contact->first_name,
            'email' => $contact->email
        ]);
    });

    it('verifies if a user without the permission can’t delete a contact', function () {
        $contact = Contact::factory()->create();

        Livewire::test('pages::contacts.index')
            ->call('openModal', modal: 'openDeleteModal', id: $contact->id)
            ->call('delete')
            ->assertForbidden();

        assertDatabaseCount('contacts', 1);
    });
});
