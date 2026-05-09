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
        return $user->can('interventions.index');
    }

    public function view(User $user, Intervention $intervention): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return $user->can('interventions.create');
    }

    public function update(User $user): bool
    {
        return $user->can('interventions.update');
    }

    public function delete(User $user): bool
    {
        return $user->can('interventions.delete');
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
