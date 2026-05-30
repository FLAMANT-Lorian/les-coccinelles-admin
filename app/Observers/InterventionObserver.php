<?php

namespace App\Observers;

use App\Mail\InterventionCreatedMail;
use App\Models\Intervention;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class InterventionObserver
{
    /**
     * Handle the Intervention "created" event.
     */
    public function created(Intervention $intervention): void
    {
        $users = User::where('notifications->interventions', true)->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new InterventionCreatedMail($intervention));
        }
    }

    /**
     * Handle the Intervention "updated" event.
     */
    public function updated(Intervention $intervention): void
    {
        //
    }

    /**
     * Handle the Intervention "deleted" event.
     */
    public function deleted(Intervention $intervention): void
    {
        //
    }

    /**
     * Handle the Intervention "restored" event.
     */
    public function restored(Intervention $intervention): void
    {
        //
    }

    /**
     * Handle the Intervention "force deleted" event.
     */
    public function forceDeleted(Intervention $intervention): void
    {
        //
    }
}
