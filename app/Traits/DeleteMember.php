<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

trait DeleteMember
{
    use HandleImages;

    #[On('delete-member')]
    public function deleteMember(int $id): void
    {
        $this->authorize('delete', User::class);

        $member = User::findOrFail($id);

        if ($member->avatar_path) {
            $this->removeOldAvatar($member->id);
        }

        if ($member->documents) {
            foreach ($member->documents as $document) {
                $this->removeOldDocument($document);
            }
        }

        $member->delete();

        session()->flash('success', __('flash-messages.member-deleted'));

        $this->redirectRoute('members.index', ['locale' => app()->getLocale()], navigate: true);
    }
}
