<?php

namespace App\Traits;

use App\Models\Event;
use Livewire\Attributes\On;

trait DeleteEvent
{

    #[On('delete-event')]
    public function deleteEvent(int $id): void
    {
        $event = Event::findOrFail($id);

        $event->delete();

        session()->flash('success', __('flash-messages.event-deleted'));

        $this->redirectRoute('events.index', navigate: true);
    }
}
