<?php

use App\Models\Booking;
use App\Models\BookingDate;
use App\Models\Contact;
use App\Models\HallRate;
use App\Models\MeterReading;

it('verifies if relations works correctly between bookings, hall rates, meter readings and contacts', function () {
    $contact = Contact::factory()->create();
    $hall_rate = HallRate::factory()->create();

    $booking = Booking::factory()
        ->contact($contact)
        ->type($hall_rate)
        ->has(MeterReading::factory())
        ->has(BookingDate::factory())
        ->create();

    expect($booking->hall_rate->type)->toBe($hall_rate->type)
        ->and($booking->contact->first_name)->toBe($contact->first_name)
        ->and($contact->bookings()->first()->hall_rate->type)->toBe($hall_rate->type)
        ->and($hall_rate->bookings()->first()->meterReading->after_mazout_general)->toBe($booking->meterReading->after_mazout_general);
});
