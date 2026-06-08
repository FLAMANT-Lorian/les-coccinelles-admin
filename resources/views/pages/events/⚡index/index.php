<?php

use App\Livewire\Forms\EventsForm;
use App\Traits\DeleteEvent;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Event;

new #[Title('page-title.events')]
class extends Component {
    use DeleteEvent;

    public EventsForm $form;

    public bool $openCreateModal = false;
    public bool $openUpdateModal = false;
    public bool $openDeleteModal = false;
    public bool $openDeleteSelectionModal = false;
    public ?Event $event = null;

    public function mount(): void
    {
        if (request()->boolean('create')) {
            $this->openModal('openCreateModal');
        }
    }

    #[On('open-modal')]
    public function openModal(string $modal, int $id = null): void
    {
        $this->dispatch('init-date-pickers');

        if ($id) {
            $this->event = Event::findOrFail($id);
        }

        if ($modal === 'openCreateModal') {
            $this->openCreateModal = true;
        } elseif ($modal === 'openUpdateModal') {
            $this->form->setEvent($this->event);
            $this->openUpdateModal = true;
        } elseif ($modal == 'openDeleteModal') {
            $this->openDeleteModal = true;
        } elseif ($modal === 'deleteSelection') {
            $this->openDeleteSelectionModal = true;
        }

    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->form->reset();
        $this->form->resetErrorBag();

        $this->openCreateModal = false;
        $this->openUpdateModal = false;
        $this->openDeleteModal = false;
    }

    public function save(): void
    {
        $this->authorize('create', Event::class);

        $this->form->validate();

        $event = $this->form->save();

        session()->flash('success', __('flash-messages.event-created'));

        $this->redirectRoute('events.show', ['event' => $event->id], navigate: true);
    }

    public function update(): void
    {
        $this->authorize('update', Event::class);

        $this->form->validate();

        $this->form->update();

        session()->flash('success', __('flash-messages.event-updated'));

        $this->redirectRoute('events.index', navigate: true);
    }
};
