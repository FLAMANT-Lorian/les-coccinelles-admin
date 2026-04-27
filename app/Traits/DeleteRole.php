<?php

namespace App\Traits;

use Livewire\Attributes\On;
use Spatie\Permission\Models\Role;

trait DeleteRole
{
    #[On('delete-role')]
    public function deleteRole(int $id): void
    {
        $role = Role::findOrFail($id)->load(['users']);

        $users = $role->users()->count();

        if ($users > 0) {
            session()->flash('error', __('flash-messages.role-cant-be-deleted', ['count' => $users]));

            $this->dispatch('close-modal');

            $this->redirectRoute('members.index', ['locale' => app()->getLocale(), 'tab' => 'roles'], navigate: true);
            return;
        }

        $role->delete();

        session()->flash('success', __('flash-messages.role-deleted'));

        $this->redirectRoute('members.index', ['locale' => app()->getLocale(), 'tab' => 'roles'], navigate: true);
    }
}
