<?php

namespace App\Observers;

use App\Mail\MessageSentMail;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class MessageObserver
{
    /**
     * Handle the Message "created" event.
     */
    public function created(Message $message): void
    {
        $users = User::where('notifications->messages', true)->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new MessageSentMail($message));
        }
    }

    /**
     * Handle the Message "updated" event.
     */
    public function updated(Message $message): void
    {
        //
    }

    /**
     * Handle the Message "deleted" event.
     */
    public function deleted(Message $message): void
    {
        //
    }

    /**
     * Handle the Message "restored" event.
     */
    public function restored(Message $message): void
    {
        //
    }

    /**
     * Handle the Message "force deleted" event.
     */
    public function forceDeleted(Message $message): void
    {
        //
    }
}
