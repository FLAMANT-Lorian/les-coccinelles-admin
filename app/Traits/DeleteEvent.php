<?php

namespace App\Traits;

use App\Models\Event;
use Livewire\Attributes\On;

trait DeleteEvent
{
    use HandleFolder;

    #[On('delete-event')]
    public function deleteEvent(int $id): void
    {
        $event = Event::findOrFail($id)->load(['folders', 'folders.files']);

        $folders = $event->folders;

        foreach ($folders as $folder) {
            $this->deleteFolder($folder->id);
        }

        $event->delete();

        session()->flash('success', __('flash-messages.event-deleted'));

        $this->redirectRoute('events.index', navigate: true);
    }
}
