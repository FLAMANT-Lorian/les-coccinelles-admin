<?php

namespace App\Policies;

use App\Models\MeterReading;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeterReadingPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, MeterReading $meterReading): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, MeterReading $meterReading): bool
    {
        return false;
    }

    public function delete(User $user, MeterReading $meterReading): bool
    {
        return false;
    }

    public function restore(User $user, MeterReading $meterReading): bool
    {
        return false;
    }

    public function forceDelete(User $user, MeterReading $meterReading): bool
    {
        return false;
    }
}
