<?php

namespace App\Traits;

use App\Models\User;
use Livewire\Attributes\On;

trait DeleteMember
{
    #[On('delete-member')]
    public function deleteMember(int $id): void
    {
        $this->authorize('delete', User::class);

        $member = User::findOrFail($id);

        $member->delete();

        session()->flash('success', __('flash-messages.member-deleted'));

        $this->redirectRoute('members.index', ['locale' => app()->getLocale()], navigate: true);
    }
}
