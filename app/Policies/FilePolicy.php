<?php

namespace App\Policies;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return $user->can('files.add');
    }

    public function update(User $user): bool
    {
        return false;
    }

    public function delete(User $user): bool
    {
        return $user->can('files.delete');
    }

    public function restore(User $user, Folder $event): bool
    {
        return false;
    }

    public function forceDelete(User $user, Folder $event): bool
    {
        return false;
    }
}
