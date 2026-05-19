<?php

use App\Models\Booking;
use App\Models\Contact;
use App\Models\HallRate;
use App\Models\MeterReading;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

describe('BOOKINGS WITH PERMISSIONS', function () {
    beforeEach(function () {
        $permission = Permission::create([
            'name' => 'bookings.edit',
            'guard_name' => 'web',
        ]);

        $this->role = Role::create([
            'name' => 'member',
            'guard_name' => 'web',
            'unique' => 1
        ])->givePermissionTo($permission);

        $user = User::factory()
            ->create()
            ->assignRole($this->role);

        $this->actingAs($user);
    });

    it('verifies if a user with the permission can create a booking', function () {
        $booking = Booking::factory()
            ->contact(Contact::factory()->create())
            ->type(HallRate::factory()->create())
            ->has(MeterReading::factory())
            ->create();

        Livewire::test('pages.bookings.forms.update.form', ['booking' => $booking])
            ->set('form.tenant', $booking->contact->id)
            ->set('form.type', $booking->hall_rate->id)
            ->set('form.dates', '2026-10-12 au 2026-10-14')
            ->set('form.handover_date', '2026-10-12')
            ->set('form.return_date', '2026-10-14')
            ->set('form.billing_address', 'Liège')
            ->call('update')
            ->assertOk();

        assertDatabaseCount('bookings', 1);
        assertDatabaseHas('bookings', [
            'start_date' => Carbon::parse('2026-10-12')->startOfDay(),
            'end_date' => Carbon::parse('2026-10-14')->endOfDay(),
        ]);
    });

    it('verifies if a user with the permission can delete a booking', function () {
        $permission = Permission::create([
            'name' => 'bookings.delete',
            'guard_name' => 'web',
        ]);

        $this->role->givePermissionTo($permission);

        $booking = Booking::factory()
            ->contact(Contact::factory()->create())
            ->type(HallRate::factory()->create())
            ->has(MeterReading::factory())
            ->create();

        Livewire::test('pages.bookings.forms.update.form', ['booking' => $booking])
            ->set('form.tenant', $booking->contact->id)
            ->set('form.type', $booking->hall_rate->id)
            ->set('form.dates', '2026-10-12 au 2026-10-14')
            ->set('form.handover_date', '2026-10-12')
            ->set('form.return_date', '2026-10-14')
            ->set('form.billing_address', 'Liège')
            ->call('deleteBooking', $booking->id)
            ->assertOk();

        assertDatabaseCount('bookings', 0);
    });
});

describe('BOOKINGS WITHOUT PERMISSIONS', function () {
    beforeEach(function () {
        $this->role = Role::create([
            'name' => 'member',
            'guard_name' => 'web',
            'unique' => 1
        ]);

        $user = User::factory()
            ->create()
            ->assignRole($this->role);

        $this->actingAs($user);
    });

    it('verifies if a user with the permission can’t create a booking', function () {
        $booking = Booking::factory()
            ->contact(Contact::factory()->create())
            ->type(HallRate::factory()->create())
            ->has(MeterReading::factory())
            ->create();

        Livewire::test('pages.bookings.forms.update.form', ['booking' => $booking])
            ->set('form.tenant', $booking->contact->id)
            ->set('form.type', $booking->hall_rate->id)
            ->set('form.dates', '2026-10-12 au 2026-10-14')
            ->set('form.handover_date', '2026-10-12')
            ->set('form.return_date', '2026-10-14')
            ->set('form.billing_address', 'Liège')
            ->call('update')
            ->assertForbidden();

        assertDatabaseHas('bookings', [
            'billing_address' => $booking->billing_address,
        ]);
    });

    it('verifies if a user with the permission can’t delete a booking', function () {
        $booking = Booking::factory()
            ->contact(Contact::factory()->create())
            ->type(HallRate::factory()->create())
            ->has(MeterReading::factory())
            ->create();

        Livewire::test('pages.bookings.forms.update.form', ['booking' => $booking])
            ->set('form.tenant', $booking->contact->id)
            ->set('form.type', $booking->hall_rate->id)
            ->set('form.dates', '2026-10-12 au 2026-10-14')
            ->set('form.handover_date', '2026-10-12')
            ->set('form.return_date', '2026-10-14')
            ->set('form.billing_address', 'Liège')
            ->call('deleteBooking', $booking->id)
            ->assertForbidden();

        assertDatabaseCount('bookings', 1);
    });
});
