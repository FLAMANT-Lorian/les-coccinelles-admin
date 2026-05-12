<?php

use App\Models\Booking;
use App\Models\Contact;
use App\Models\HallRate;
use App\Models\MeterReading;

it('verifies if relations works correctly between bookings, hall rates and contacts', function () {
    $contact = Contact::factory()->create();
    $hall_rate = HallRate::factory()->create();

    $booking = Booking::factory()->create([
        'contact_id' => $contact->id,
        'hall_rate_id' => $hall_rate->id
    ]);

    expect($booking->hall_rate->type)->toBe($hall_rate->type)
        ->and($booking->contact->first_name)->toBe($contact->first_name)
        ->and($hall_rate->bookings()->first()->status)->toBe($contact->bookings()->first()->status)
        ->and($contact->bookings()->first()->hall_rate->type)->toBe($hall_rate->type);
});

it('verifies if relations works correctly between bookings and meter readings', function () {
    $contact = Contact::factory()->create();
    $hall_rate = HallRate::factory()->create();

    $booking = Booking::factory()
        ->create([
            'contact_id' => $contact->id,
            'hall_rate_id' => $hall_rate->id
        ]);

    $meter_reading = MeterReading::factory()
        ->create(['booking_id' => $booking->id]);

    expect($booking->meterReading->before_water_general)->toBe($meter_reading->before_water_general)
        ->and($meter_reading->booking->hall_rate->type)->toBe($hall_rate->type)
        ->and($meter_reading->booking->status)->toBe($booking->status);
});
