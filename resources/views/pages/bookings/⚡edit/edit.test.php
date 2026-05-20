<?php

use App\Enums\DepositStatus;
use App\Models\Booking;
use App\Models\BookingDate;
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

    it('can create a booking', function () {
        $permission = Permission::create([
            'name' => 'bookings.create',
            'guard_name' => 'web',
        ]);

        $this->role->givePermissionTo($permission);

        $contact = Contact::factory()->create();
        $hall_rate = HallRate::factory()->create();

        Livewire::test('pages.bookings.forms.create.form')
            ->set('form.tenant', $contact->id)
            ->set('form.type', $hall_rate->id)
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
        assertDatabaseCount('booking_dates', 1);
        assertDatabaseCount('meter_readings', 1);
    });

    it('can update a booking', function () {
        $permission = Permission::create([
            'name' => 'bookings.edit',
            'guard_name' => 'web',
        ]);

        $this->role->givePermissionTo($permission);

        $booking = Booking::factory()
            ->contact(Contact::factory()->create())
            ->type(HallRate::factory()->create())
            ->has(BookingDate::factory())
            ->has(MeterReading::factory())
            ->create();

        Livewire::test('pages.bookings.forms.update.form', ['booking' => $booking])
            ->set('form.tenant', $booking->contact->id)
            ->set('form.type', $booking->hall_rate->id)
            ->set('form.deposit_status', DepositStatus::PAID->value)
            ->set('form.dates', '2026-10-12 au 2026-10-14')
            ->set('form.handover_date', '2026-10-12')
            ->set('form.handover_hour', '19:00')
            ->set('form.return_date', '2026-10-14')
            ->set('form.return_hour', '19:00')
            ->set('form.billing_address', 'Liège')
            ->call('update')
            ->assertOk();

        assertDatabaseCount('bookings', 1);

        assertDatabaseHas('bookings', [
            'deposit_status' => DepositStatus::PAID->value,
            'billing_address' => 'Liège'
        ]);

        assertDatabaseHas('booking_dates', [
            'start_date' => Carbon::parse('2026-10-12')->startOfDay(),
            'end_date' => Carbon::parse('2026-10-14')->endOfDay(),
        ]);
    });

    it('can delete a booking', function () {
        $permission = Permission::create([
            'name' => 'bookings.delete',
            'guard_name' => 'web',
        ]);

        $this->role->givePermissionTo($permission);

        $booking = Booking::factory()
            ->contact(Contact::factory()->create())
            ->type(HallRate::factory()->create())
            ->has(BookingDate::factory())
            ->has(MeterReading::factory())
            ->create();

        Livewire::test('pages.bookings.forms.update.form', ['booking' => $booking])
            ->set('form.tenant', $booking->contact->id)
            ->set('form.type', $booking->hall_rate->id)
            ->set('form.deposit_status', DepositStatus::PAID->value)
            ->set('form.dates', '2026-10-12 au 2026-10-14')
            ->set('form.handover_date', '2026-10-12')
            ->set('form.handover_hour', '19:00')
            ->set('form.return_date', '2026-10-14')
            ->set('form.return_hour', '19:00')
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

    it('can’t create a booking', function () {
        $booking = Booking::factory()
            ->contact(Contact::factory()->create())
            ->type(HallRate::factory()->create())
            ->has(BookingDate::factory())
            ->has(MeterReading::factory())
            ->create();

        Livewire::test('pages.bookings.forms.update.form', ['booking' => $booking])
            ->set('form.tenant', $booking->contact->id)
            ->set('form.type', $booking->hall_rate->id)
            ->set('form.deposit_status', DepositStatus::PAID->value)
            ->set('form.dates', '2026-10-12 au 2026-10-14')
            ->set('form.handover_date', '2026-10-12')
            ->set('form.handover_hour', '19:00')
            ->set('form.return_date', '2026-10-14')
            ->set('form.return_hour', '19:00')
            ->set('form.billing_address', 'Liège')
            ->call('update')
            ->assertForbidden();

        assertDatabaseHas('bookings', [
            'billing_address' => $booking->billing_address,
        ]);
    });

    it('can’t update a booking', function () {
        $booking = Booking::factory()
            ->contact(Contact::factory()->create())
            ->type(HallRate::factory()->create())
            ->has(BookingDate::factory())
            ->has(MeterReading::factory())
            ->create();

        Livewire::test('pages.bookings.forms.update.form', ['booking' => $booking])
            ->set('form.tenant', $booking->contact->id)
            ->set('form.type', $booking->hall_rate->id)
            ->set('form.deposit_status', DepositStatus::PAID->value)
            ->set('form.dates', '2026-10-12 au 2026-10-14')
            ->set('form.handover_date', '2026-10-12')
            ->set('form.handover_hour', '19:00')
            ->set('form.return_date', '2026-10-14')
            ->set('form.return_hour', '19:00')
            ->set('form.billing_address', 'Liège')
            ->call('update')
            ->assertForbidden();

        assertDatabaseCount('bookings', 1);

        assertDatabaseHas('bookings', [
            'deposit_status' => $booking->deposit_status,
            'billing_address' => $booking->billing_address
        ]);

        assertDatabaseHas('booking_dates', [
            'start_date' => Carbon::parse($booking->bookingDate->start_date)->startOfDay(),
            'end_date' => Carbon::parse($booking->bookingDate->end_date)->endOfDay(),
        ]);
    });

    it('can’t delete a booking', function () {
        $booking = Booking::factory()
            ->contact(Contact::factory()->create())
            ->type(HallRate::factory()->create())
            ->has(BookingDate::factory())
            ->has(MeterReading::factory())
            ->create();

        Livewire::test('pages.bookings.forms.update.form', ['booking' => $booking])
            ->set('form.tenant', $booking->contact->id)
            ->set('form.type', $booking->hall_rate->id)
            ->set('form.deposit_status', DepositStatus::PAID->value)
            ->set('form.dates', '2026-10-12 au 2026-10-14')
            ->set('form.handover_date', '2026-10-12')
            ->set('form.handover_hour', '19:00')
            ->set('form.return_date', '2026-10-14')
            ->set('form.return_hour', '19:00')
            ->set('form.billing_address', 'Liège')
            ->call('deleteBooking', $booking->id)
            ->assertForbidden();

        assertDatabaseCount('bookings', 1);
    });
});
