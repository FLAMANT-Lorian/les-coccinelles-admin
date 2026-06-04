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
        return $user->can('meetings.index');
    }

    public function view(User $user, Meeting $meeting): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return $user->can('meetings.create');
    }

    public function update(User $user): bool
    {
        return $user->can('meetings.edit');
    }

    public function delete(User $user): bool
    {
        return $user->can('meetings.delete');
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
