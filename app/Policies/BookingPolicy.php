<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('bookings.index');
    }

    public function view(User $user, Booking $booking): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return $user->can('bookings.create');
    }

    public function update(User $user): bool
    {
        return $user->can('bookings.update');
    }

    public function delete(User $user): bool
    {
        return $user->can('bookings.delete');
    }

    public function restore(User $user, Booking $booking): bool
    {
        return false;
    }

    public function forceDelete(User $user, Booking $booking): bool
    {
        return false;
    }
}
