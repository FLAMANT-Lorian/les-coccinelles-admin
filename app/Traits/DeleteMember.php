<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

trait DeleteMember
{
    #[On('delete-member')]
    public function deleteMember(int $id): void
    {
        $this->authorize('delete', User::class);

        $member = User::findOrFail($id);

        $this->removeAvatar($id);

        $member->delete();

        session()->flash('success', __('flash-messages.member-deleted'));

        $this->redirectRoute('members.index', ['locale' => app()->getLocale()], navigate: true);
    }

    #[On('remove-avatar')]
    public function removeAvatar($id): void
    {
        $member = User::findOrFail($id);

        $path = config('avatar.original_path') . $member->avatar_path;

        if (Storage::disk(config('filesystems.default'))->exists($path)) {
            Storage::disk(config('filesystems.default'))->delete($path);
        }
    }
}
