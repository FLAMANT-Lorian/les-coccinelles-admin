<?php

use App\Livewire\Forms\EventsForm;
use App\Models\Folder;
use App\Traits\DeleteEvent;
use App\Traits\HandleFolder;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Event;

new class extends Component {
    use DeleteEvent;
    use HandleFolder;

    public Event $event;
    public EventsForm $form;

    public function mount(Event $event): void
    {
        $this->event = $event->load(['folders']);
    }

    public bool $openEditModal = false;
    public bool $openDeleteModal = false;
    public bool $openCreateFolderModal = false;
    public bool $openUpdateFolderModal = false;
    public bool $openDeleteFolderModal = false;
    public Folder $folder;
    public bool $openFolderModal = false;

    #[On('open-modal')]
    public function openModal(string $modal, int $folder_id = null): void
    {
        $this->dispatch('init-date-pickers');

        if ($folder_id) {
            $this->folder = $this->event->folders->findOrFail($folder_id);
        }

        if ($modal === 'openEditModal') {
            $this->form->setEvent($this->event);
            $this->openEditModal = true;
        } elseif ($modal === 'openDeleteModal') {
            $this->openDeleteModal = true;
        } elseif ($modal === 'openCreateFolderModal') {
            $this->openCreateFolderModal = true;
        } elseif ($modal === 'openUpdateFolderModal') {
            $this->folderForm->setFolder($this->folder);
            $this->openUpdateFolderModal = true;
        } elseif ($modal === 'openDeleteFolderModal') {
            $this->openDeleteFolderModal = true;
        } elseif ($modal === 'openFolderModal') {
            $this->openFolderModal = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->form->reset();
        $this->form->resetErrorBag();

        $this->openEditModal = false;
        $this->openDeleteModal = false;
        $this->openFolderModal = false;
        $this->openCreateFolderModal = false;
        $this->openUpdateFolderModal = false;
        $this->openDeleteFolderModal = false;
    }

    public function update(): void
    {
        $this->form->validate();

        $this->form->update();

        session()->flash('success', __('flash-messages.event-updated'));

        $this->redirectRoute('events.show', ['event' => $this->event->id], navigate: true);
    }
};
