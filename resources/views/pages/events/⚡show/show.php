<?php

use App\Livewire\Forms\EventsForm;
use App\Livewire\Forms\FoldersForm;
use App\Models\Folder;
use App\Traits\DeleteEvent;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Event;

new class extends Component {
    use DeleteEvent;

    public Event $event;
    public EventsForm $form;
    public FoldersForm $folderForm;

    public function mount(Event $event): void
    {
        $this->event = $event->load(['folders']);
    }

    public bool $openEditModal = false;
    public bool $openDeleteModal = false;
    public bool $openCreateFolderModal = false;
    public Folder $folderToOpen;
    public bool $openFolderModal = false;

    #[On('open-modal')]
    public function openModal(string $modal, int $folder_id = null): void
    {
        $this->dispatch('init-date-pickers');

        if ($modal === 'openEditModal') {
            $this->form->setEvent($this->event);
            $this->openEditModal = true;
        } elseif ($modal === 'openDeleteModal') {
            $this->openDeleteModal = true;
        } elseif ($modal === 'openCreateFolderModal') {
            $this->openCreateFolderModal = true;
        } elseif ($modal === 'openFolderModal') {
            $this->folderToOpen = $this->event->folders->findOrFail($folder_id);
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
    }

    public function update(): void
    {
        $this->form->validate();

        $this->form->update();

        session()->flash('success', __('flash-messages.event-updated'));

        $this->redirectRoute('events.show', ['event' => $this->event->id], navigate: true);
    }

    public function saveFolder(): void
    {
        $this->folderForm->validate();

        $this->folderForm->save($this->event);

        session()->flash('success', __('flash-messages.folder-created'));

        $this->redirectRoute('events.show', ['event' => $this->event->id], navigate: true);
    }
};
