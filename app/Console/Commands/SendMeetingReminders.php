<?php

namespace App\Console\Commands;

use App\Mail\MeetingReminderMail;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

#[Signature('meetings:send-meeting-reminders')]
#[Description('Command description')]
class SendMeetingReminders extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = now()->addDay();
        $meetings = Meeting::whereDate('date', $tomorrow)->get();

        $users = User::where('notifications->meetings', true)->get();

        $count = 0;

        foreach ($meetings as $meeting) {
            foreach ($users as $user) {
                Mail::to($user->email)->send(new MeetingReminderMail($meeting));
                $count++;
            }
        }

        $this->info($count . ' rappel(s) envoyé(s).');
    }
}
