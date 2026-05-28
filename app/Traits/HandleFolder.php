<?php

namespace App\Traits;

use App\Livewire\Forms\FoldersForm;
use App\Models\Folder;
use Livewire\Attributes\On;


trait HandleFolder
{
    public FoldersForm $folderForm;

    public function saveFolder(): void
    {
        $this->folderForm->validate();

        $this->folderForm->save($this->event);

        session()->flash('success', __('flash-messages.folder-created'));

        $this->redirectRoute('events.show', ['event' => $this->event->id], navigate: true);
    }

    public function updateFolder(): void
    {
        $this->folderForm->validate();

        $this->folderForm->update();

        session()->flash('success', __('flash-messages.folder-updated'));

        $this->redirectRoute('events.show', ['event' => $this->event->id], navigate: true);
    }

    #[On('delete-folder')]
    public function deleteFolder(int $id): void
    {
        $folder = Folder::findOrFail($id);

        $folder->delete();

        session()->flash('success', __('flash-messages.folder-deleted'));

        $this->redirectRoute('events.show', ['event' => $this->event->id], navigate: true);
    }
}
