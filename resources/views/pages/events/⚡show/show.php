<?php

use App\Livewire\Forms\EventsForm;
use App\Traits\DeleteEvent;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Event;

new class extends Component {
    use DeleteEvent;

    public Event $event;
    public EventsForm $form;

    public function mount(Event $event): void
    {
        $this->event = $event;
    }

    public bool $openEditModal = false;
    public bool $openDeleteModal = false;

    #[On('open-modal')]
    public function openModal(string $modal): void
    {
        $this->dispatch('init-date-pickers');

        if ($modal === 'openEditModal') {
            $this->form->setEvent($this->event);
            $this->openEditModal = true;
        } elseif ($modal === 'openDeleteModal') {
            $this->openDeleteModal = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->form->reset();
        $this->form->resetErrorBag();

        $this->openEditModal = false;
        $this->openDeleteModal = false;
    }

    public function update(): void
    {
        $this->form->validate();

        $this->form->update();

        session()->flash('success', __('flash-messages.event-updated'));

        $this->redirectRoute('events.show', ['event' => $this->event->id], navigate: true);
    }
};
