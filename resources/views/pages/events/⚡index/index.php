<?php

use App\Livewire\Forms\EventsForm;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {

    public EventsForm $form;

    public bool $openCreateModal = false;

    #[On('open-modal')]
    public function openModal(string $modal, int $id = null): void
    {
        $this->dispatch('init-date-pickers');

        if ($modal === 'openCreateModal')
            $this->openCreateModal = true;
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->openCreateModal = false;
    }

    public function save(): void
    {
        $this->form->validate();

        $this->form->save();

        session()->flash('success', __('flash-messages.event-created'));

        $this->redirectRoute('events.index', navigate: true);
    }
};
