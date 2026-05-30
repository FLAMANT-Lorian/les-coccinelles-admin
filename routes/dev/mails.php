<?php

use App\Mail\AvailabilityRequestSentMail;
use App\Mail\BookingCreatedMail;
use App\Mail\EventReminderMail;
use App\Mail\MeetingCreatedMail;
use App\Mail\MemberCreatedMail;
use App\Mail\MessageSentMail;
use App\Mail\TaskCreatedMail;
use App\Models\AvailabilityRequest;
use App\Models\Booking;
use App\Models\BookingDate;
use App\Models\Contact;
use App\Models\HallRate;
use App\Models\Meeting;
use App\Models\Message;
use App\Models\MeterReading;
use App\Models\Task;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

Route::get('/mail-member', function () {
    $user = auth()->user();
    $old_password = 'password';

    return new MemberCreatedMail($user, $old_password);
});

Route::get('/mail-message', function () {
    $message = Message::factory()->create();

    $mail = new MessageSentMail($message);

    $message->delete();

    return $mail;
});


Route::get('/mail-availability', function () {
    $availability = AvailabilityRequest::factory()->create();

    $mail = new AvailabilityRequestSentMail($availability);

    $availability->delete();

    return $mail;
});

Route::get('/mail-task', function () {
    $event = Event::factory()->create();
    $task = Task::factory()
        ->for($event)
        ->assignedTo(auth()->user())
        ->create();

    $mail = new TaskCreatedMail($task);

    $event->delete();

    return $mail;
});

Route::get('/mail-reminder', function () {
    $event = Event::factory()->create();

    $mail = new EventReminderMail($event);

    $event->delete();

    return $mail;
});

Route::get('/mail-booking', function () {
    $contact = Contact::factory()->create();
    $hall_rate = HallRate::factory()->create();

    $booking = Booking::factory()
        ->contact($contact)
        ->type($hall_rate)
        ->has(MeterReading::factory())
        ->has(BookingDate::factory())
        ->create()
    ->load([
        'contact',
        'hall_rate',
        'bookingDate',
        'meterReading',
    ]);

    $mail = new BookingCreatedMail($booking);

    $booking->delete();

    Mail::to($booking->contact->email)->send($mail);

    return $mail;
});

Route::get('/mail-meeting', function () {
    $meeting = Meeting::factory()->create();

    $mail = new MeetingCreatedMail($meeting);

    $meeting->delete();

    return $mail;
});
