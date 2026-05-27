<?php

use Livewire\Component;
use App\Models\Event;

new class extends Component
{
    public Event $event;

    public function mount(Event $event): void
    {
        $this->event = $event;
    }
};
