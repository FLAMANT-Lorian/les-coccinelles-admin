<?php

use App\Models\Booking;
use App\Models\Contact;
use App\Models\HallRate;
use App\Models\Meeting;
use App\Models\MeterReading;
use App\Models\User;
use function Pest\Laravel\assertDatabaseCount;

it('verifies if relations works correctly between meetings and users', function () {
    $users = User::factory()->count(2)->create()->pluck('id');

    $meeting = Meeting::factory()->create();

    $meeting->participants()->attach($users);

    assertDatabaseCount('meetings', 1);
    assertDatabaseCount('attendances', 2);

    expect($meeting->participants()->count())->toBe(2)
        ->and(User::first()->meetings()->first()->description)->toBe($meeting->description)
        ->and(User::first()->meetings()->first()->participants()->count())->toBe(2);
});
