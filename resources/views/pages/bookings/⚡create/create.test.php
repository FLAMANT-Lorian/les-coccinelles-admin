<?php

use App\Enums\DepositStatus;
use App\Models\Contact;
use App\Models\HallRate;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;
use function Pest\Laravel\assertDatabaseCount;

describe('BOOKINGS WITH PERMISSIONS', function () {
    beforeEach(function () {
        $permission = Permission::create([
            'name' => 'bookings.create',
            'guard_name' => 'web',
        ]);

        $role = Role::create([
            'name' => 'member',
            'guard_name' => 'web',
            'unique' => 1
        ])->givePermissionTo($permission);

        $user = User::factory()
            ->create()
            ->assignRole($role);

        $this->actingAs($user);
    });

    it('can access to the booking create form', function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('bookings.create'))
            ->assertOk();
    });

    it('can create a booking', function () {
        $contact = Contact::factory()->create();
        $hallRate = HallRate::factory()->create();

        Livewire::test('pages.bookings.forms.create.form')
            ->set('form.tenant', $contact->id)
            ->set('form.type', $hallRate->id)
            ->set('form.deposit_status', DepositStatus::PAID->value)
            ->set('form.dates', '2026-10-12 au 2026-10-14')
            ->set('form.handover_date', '2026-10-12')
            ->set('form.handover_hour', '19:00')
            ->set('form.return_date', '2026-10-14')
            ->set('form.return_hour', '19:00')
            ->set('form.billing_address', 'Liège')
            ->call('save')
            ->assertOk();

        assertDatabaseCount('bookings', 1);
    });

    it('verifies if a validation works correctly for booking creation', function () {
       Livewire::test('pages.bookings.forms.create.form')
            ->set('form.tenant', null)
            ->set('form.type', null)
            ->set('form.dates', '')
           ->set('form.prepayment', 10.987)
            ->set('form.handover_date', null)
            ->set('form.return_date', null)
            ->set('form.billing_address', '')
            ->call('save')
            ->assertHasErrors([
                'form.last_name',
                'form.last_name',
                'form.type',
                'form.dates',
                'form.handover_date',
                'form.return_date',
                'form.billing_address',
                'form.prepayment'
            ]);

        assertDatabaseCount('bookings', 0);
    });
});

describe('BOOKINGS WITHOUT PERMISSIONS', function () {
    beforeEach(function () {
        $role = Role::create([
            'name' => 'member',
            'guard_name' => 'web',
            'unique' => 1
        ]);

        $user = User::factory()
            ->create()
            ->assignRole($role);

        $this->actingAs($user);
    });

    it('can’t access to the booking create form', function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])->get(route('bookings.create'))
            ->assertForbidden();
    });

    it('can’t create a booking', function () {
        $contact = Contact::factory()->create();
        $hallRate = HallRate::factory()->create();

        Livewire::test('pages.bookings.forms.create.form')
            ->set('form.tenant', $contact->id)
            ->set('form.type', $hallRate->id)
            ->set('form.dates', '2026-10-12 au 2026-10-14')
            ->set('form.handover_date', '2026-10-12')
            ->set('form.return_date', '2026-10-14')
            ->set('form.billing_address', 'Liège')
            ->call('save')
            ->assertForbidden();

        assertDatabaseCount('bookings', 0);
    });
});

