<?php

use App\Models\AvailabilityRequest;
use App\Models\Message;
use App\Models\Task;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

Route::get('/mail-member', function () {
    $user = auth()->user();
    $old_password = 'password';

    return new App\Mail\MemberCreatedMail($user, $old_password);
});

Route::get('/mail-message', function () {
    $message = Message::factory()->create();

    $mail = new App\Mail\MessageSentMail($message);

    $message->delete();

    return $mail;
});


Route::get('/mail-availability', function () {
    $availability = AvailabilityRequest::factory()->create();

    $mail = new App\Mail\AvailabilityRequestSentMail($availability);

    $availability->delete();

    return $mail;
});

Route::get('/mail-task', function () {
    $event = Event::factory()->create();
    $task = Task::factory()
        ->for($event)
        ->assignedTo(auth()->user())
        ->create();

    $mail = new App\Mail\TaskCreatedMail($task);

    $event->delete();

    return $mail;
});

Route::get('/mail-reminder', function () {
    $event = Event::factory()->create();

    $mail =  new App\Mail\EventReminderMail($event);

    $event->delete();

    return $mail;
});

