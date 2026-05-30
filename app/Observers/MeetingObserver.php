<?php

namespace App\Observers;

use App\Mail\MeetingCreatedMail;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class MeetingObserver
{
    /**
     * Handle the Meeting "created" event.
     */
    public function created(Meeting $meeting): void
    {
        $users = User::where('notifications->meetings', true)->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new MeetingCreatedMail($meeting));
        }
    }

    /**
     * Handle the Meeting "updated" event.
     */
    public function updated(Meeting $meeting): void
    {
        //
    }

    /**
     * Handle the Meeting "deleted" event.
     */
    public function deleted(Meeting $meeting): void
    {
        //
    }

    /**
     * Handle the Meeting "restored" event.
     */
    public function restored(Meeting $meeting): void
    {
        //
    }

    /**
     * Handle the Meeting "force deleted" event.
     */
    public function forceDeleted(Meeting $meeting): void
    {
        //
    }
}
