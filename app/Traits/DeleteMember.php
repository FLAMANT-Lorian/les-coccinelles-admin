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

        $original_path = config('avatar.original_path') . '/' . $member->avatar_path;
        $disk = config('filesystems.default');
        $sizes = config('avatar.sizes');

        if (Storage::disk($disk)->exists($original_path)) {
            Storage::disk($disk)->delete($original_path);
        }

        foreach ($sizes as $size) {
            $variant_path = sprintf(
                    config('avatar.variant_path'),
                    $size['width'],
                    $size['height']
                ) . '/' . $member->avatar_path;
            if (Storage::disk($disk)->exists($variant_path)) {
                Storage::disk($disk)->delete($variant_path);
            }
        }
    }
}
