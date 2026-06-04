<?php

namespace App\Console\Commands;

use App\Mail\EventReminderMail;
use App\Models\Event;
use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

#[Signature('events:send-event-reminders')]
#[Description('Command description')]
class SendEventReminders extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $next_week = now()->addDays(7);
        $events = Event::whereDate('start_date', $next_week)->get();

        $users = User::where('notifications->events', true)->get();

        foreach ($events as $event) {
            foreach ($users as $user) {
                Mail::to($user->email)->send(new EventReminderMail($event));
            }
        }

        $this->info($events->count() . ' rappel(s) envoyé(s).');
    }
}
