<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UtilityCost;
use Illuminate\Auth\Access\HandlesAuthorization;

class UtilityCostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('utilityCosts.index');
    }

    public function view(User $user, UtilityCost $utilityCost): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user): bool
    {
        return $user->can('utilityCosts.update');
    }

    public function delete(User $user): bool
    {
        return false;
    }

    public function restore(User $user, UtilityCost $utilityCost): bool
    {
        return false;
    }

    public function forceDelete(User $user, UtilityCost $utilityCost): bool
    {
        return false;
    }
}
