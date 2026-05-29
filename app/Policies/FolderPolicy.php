<?php

namespace App\Policies;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FolderPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('folders.index');
    }

    public function view(User $user): bool
    {
        return $user->can('folders.show');
    }

    public function create(User $user): bool
    {
        return $user->can('folders.create');
    }

    public function update(User $user): bool
    {
        return $user->can('folders.edit');
    }

    public function delete(User $user): bool
    {
        return $user->can('folders.delete');
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
