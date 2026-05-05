<?php

namespace App\Policies;

use App\Models\HallRate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HallRatePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('hallRates.index');
    }

    public function view(User $user, HallRate $hallRate): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return $user->can('hallRates.create');
    }

    public function update(User $user): bool
    {
        return $user->can('hallRates.update');
    }

    public function delete(User $user): bool
    {
        return $user->can('hallRates.delete');
    }

    public function restore(User $user, HallRate $hallRate): bool
    {
        return false;
    }

    public function forceDelete(User $user, HallRate $hallRate): bool
    {
        return false;
    }
}
