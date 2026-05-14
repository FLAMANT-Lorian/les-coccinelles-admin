<?php

use App\Models\Booking;
use App\Models\MeterReading;
use Livewire\Livewire;

it('renders successfully', function () {
    $booking = Booking::factory()
        ->has(MeterReading::factory())
        ->create();

    Livewire::test('pages::bookings.update', ['booking' => $booking])
        ->assertStatus(200);
});
