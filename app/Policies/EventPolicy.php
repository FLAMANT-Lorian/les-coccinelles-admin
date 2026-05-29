<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('events.index');
    }

    public function view(User $user): bool
    {
        return $user->can('events.show');;
    }

    public function create(User $user): bool
    {
        return $user->can('events.create');
    }

    public function update(User $user): bool
    {
        return $user->can('events.edit');
    }

    public function delete(User $user): bool
    {
        return $user->can('events.delete');
    }

    public function restore(User $user, Event $event): bool
    {
        return false;
    }

    public function forceDelete(User $user, Event $event): bool
    {
        return false;
    }
}
