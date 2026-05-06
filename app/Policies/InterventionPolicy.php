<?php

namespace App\Policies;

use App\Models\Intervention;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InterventionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Intervention $intervention): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Intervention $intervention): bool
    {
        return false;
    }

    public function delete(User $user, Intervention $intervention): bool
    {
        return false;
    }

    public function restore(User $user, Intervention $intervention): bool
    {
        return false;
    }

    public function forceDelete(User $user, Intervention $intervention): bool
    {
        return false;
    }
}
