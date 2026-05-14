<?php

namespace App\Policies;

use App\Models\AvailabilityRequest;
use App\Models\User;

class AvailabilityRequestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('availabilities.index');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AvailabilityRequest $availabilityRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->can('availabilities.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->can('availabilities.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AvailabilityRequest $availabilityRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AvailabilityRequest $availabilityRequest): bool
    {
        return false;
    }
}
