<?php

namespace App\Traits;

use Livewire\Attributes\On;
use Spatie\Permission\Models\Role;

trait DeleteRole
{
    #[On('delete-role')]
    public function deleteRole(int $id): void
    {
        $this->authorize('delete', Role::class);

        $role = Role::findOrFail($id)->load(['users']);

        $users = $role->users()->count();

        if ($users > 0) {
            session()->flash('error', __('flash-messages.role-cant-be-deleted', ['count' => $users]));

            $this->redirectRoute('roles.index', navigate: true);
            return;
        }

        $role->delete();

        session()->flash('success', __('flash-messages.role-deleted'));

        $this->redirectRoute('roles.index', navigate: true);
    }
}
