<?php

namespace App\Traits;

use App\Enums\MessageStatus;
use App\Models\Message;
use App\Models\User;
use Livewire\Attributes\On;
use Spatie\Permission\Models\Role;

trait TableSelectedColumn
{
    use HandleImages;

    public array $selectedColumn = [];

    #[On('deleteMessages')]
    public function deleteMessages(): void
    {
        $this->authorize('delete', Message::class);

        $messages = Message::whereIn('id', $this->selectedColumn)->get();

        foreach ($messages as $message) {
            $message->delete();
        }

        $this->dispatch('close-modal');
        $this->selectedColumn = [];

        session()->flash('success', __('flash-messages.messages-deleted'));

        $this->redirectRoute('messages', ['locale' => app()->getLocale()], navigate: true);
    }

    #[On('deleteMembers')]
    public function deleteMembers(): void
    {
        $this->authorize('delete', User::class);

        $members = User::whereIn('id', $this->selectedColumn)->get();

        foreach ($members as $member) {
            if ($member->avatar_path) {
                $this->removeOldAvatar($member->id);
            }

            if ($member->documents) {
                foreach ($member->documents as $document) {
                    $this->removeOldDocument($document);
                }
            }
            $member->delete();
        }


        $this->dispatch('close-modal');
        $this->selectedColumn = [];

        session()->flash('success', __('flash-messages.members-deleted'));

        $this->redirectRoute('members.index', ['locale' => app()->getLocale()], navigate: true);
    }

    #[On('deleteAllRoles')]
    public function deleteRoles(): void
    {
        $this->authorize('delete', Role::class);

        $hasUsers = false;

        $roles = Role::whereIn('id', $this->selectedColumn)->get();

        foreach ($roles as $role) {
            $users = $role->users()->count();

            if ($users > 0) {
                $hasUsers = true;
                break;
            }
        }

        if ($hasUsers) {
            $this->dispatch('close-modal');

            session()->flash('error', __('flash-messages.roles-cant-be-deleted', ['count' => $users]));

            $this->redirectRoute('roles.index', ['locale' => app()->getLocale()], navigate: true);
            return;
        }

        foreach ($roles as $role) {
            $role->delete();

            session()->flash('success', __('flash-messages.roles-deleted'));

            $this->redirectRoute('roles.index', ['locale' => app()->getLocale()], navigate: true);
        }
    }

    #[On('markMessageSelectionAs')]
    public function markMessageSelectionAs(string $value): void
    {
        $this->authorize('update', Message::class);

        if (!in_array($value, enumToArray(MessageStatus::class))) {
            $this->selectedColumn = [];
            return;
        }

        foreach ($this->selectedColumn as $id) {
            $message = Message::findOrFail($id);

            if (!$message) return;

            $message->update([
                'status' => $value
            ]);
        }
    }

    #[On('markMessageAs')]
    public function markMessageAs(string $value, int $id): void
    {
        if (!auth()->user()->can('messages.update')) {
            return;
        }

        if (!in_array($value, enumToArray(MessageStatus::class))) {
            return;
        }
        $message = Message::findOrFail($id);

        if (!$message) return;

        $message->update([
            'status' => $value
        ]);
    }
}
