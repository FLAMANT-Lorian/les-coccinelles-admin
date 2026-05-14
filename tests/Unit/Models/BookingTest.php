<?php

use App\Models\Booking;
use App\Models\Contact;
use App\Models\HallRate;
use App\Models\MeterReading;

it('verifies if relations works correctly between bookings, hall rates, meter readings and contacts', function () {
    $contact = Contact::factory()->create();
    $hall_rate = HallRate::factory()->create();

    $booking = Booking::factory()
        ->create([
            'contact_id' => $contact->id,
            'hall_rate_id' => $hall_rate->id
        ]);

    $meter_reading = MeterReading::factory()->create(['booking_id' => $booking->id]);

    expect($booking->hall_rate->type)->toBe($hall_rate->type)
        ->and($booking->contact->first_name)->toBe($contact->first_name)
        ->and($contact->bookings()->first()->hall_rate->type)->toBe($hall_rate->type)
        ->and($meter_reading->booking->message)->toBe($booking->message);
});
