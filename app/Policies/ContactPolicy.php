<?php

namespace App\Policies;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('contacts.index');
    }

    public function view(User $user, Contact $contact): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return $user->can('contacts.create');
    }

    public function update(User $user): bool
    {
        return $user->can('contacts.update');
    }

    public function delete(User $user): bool
    {
        return $user->can('contacts.delete');
    }

    public function restore(User $user, Contact $contact): bool
    {
        return false;
    }

    public function forceDelete(User $user, Contact $contact): bool
    {
        return false;
    }
}
