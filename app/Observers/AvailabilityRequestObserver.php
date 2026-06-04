<?php

namespace App\Observers;

use App\Mail\AvailabilityRequestSentMail;
use App\Models\AvailabilityRequest;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AvailabilityRequestObserver
{
    /**
     * Handle the AvailabilityRequest "created" event.
     */
    public function created(AvailabilityRequest $availabilityRequest): void
    {
        $users = User::where('notifications->availabilities', true)->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new AvailabilityRequestSentMail($availabilityRequest));
        }
    }

    /**
     * Handle the AvailabilityRequest "updated" event.
     */
    public function updated(AvailabilityRequest $availabilityRequest): void
    {
        //
    }

    /**
     * Handle the AvailabilityRequest "deleted" event.
     */
    public function deleted(AvailabilityRequest $availabilityRequest): void
    {
        //
    }

    /**
     * Handle the AvailabilityRequest "restored" event.
     */
    public function restored(AvailabilityRequest $availabilityRequest): void
    {
        //
    }

    /**
     * Handle the AvailabilityRequest "force deleted" event.
     */
    public function forceDeleted(AvailabilityRequest $availabilityRequest): void
    {
        //
    }
}
