<?php

use App\Models\Booking;
use App\Models\Contact;
use App\Models\HallRate;

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
