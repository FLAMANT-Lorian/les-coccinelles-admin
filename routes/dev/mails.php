<?php

use App\Models\AvailabilityRequest;
use App\Models\Message;
use Illuminate\Support\Facades\Route;

Route::get('/mail-member', function () {
    $user = auth()->user();
    $old_password = 'password';

    return new App\Mail\MemberCreatedMail($user, $old_password);
});

Route::get('/mail-message', function () {
    $message = Message::factory()->create();

    return new App\Mail\MessageSentMail($message);
});


Route::get('/mail-availability', function () {
   $availability = AvailabilityRequest::factory()->create();

    return new App\Mail\AvailabilityRequestSentMail($availability);
});

