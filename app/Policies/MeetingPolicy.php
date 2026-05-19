<?php

namespace App\Policies;

use App\Models\Meeting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeetingPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Meeting $meeting): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Meeting $meeting): bool
    {
        return false;
    }

    public function delete(User $user, Meeting $meeting): bool
    {
        return false;
    }

    public function restore(User $user, Meeting $meeting): bool
    {
        return false;
    }

    public function forceDelete(User $user, Meeting $meeting): bool
    {
        return false;
    }
}
