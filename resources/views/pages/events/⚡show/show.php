<?php

use App\Livewire\Forms\EventsForm;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Event;

new class extends Component {
    public Event $event;

    public EventsForm $form;

    public function mount(Event $event): void
    {
        $this->event = $event;
        $this->form->setEvent($this->event);
    }

    public bool $openEditModal = false;

    #[On('open-modal')]
    public function openModal(string $modal): void
    {
        $this->dispatch('init-date-pickers');

        if ($modal === 'openEditModal')
            $this->openEditModal = true;
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->openEditModal = false;
    }

    public function update(): void
    {
        $this->form->validate();

        $this->form->update();

        session()->flash('success', __('flash-messages.event-updated'));

        $this->redirectRoute('events.show', ['event' => $this->event->id], navigate: true);
    }
};
