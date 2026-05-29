<?php

namespace App\Traits;

use App\Livewire\Forms\FoldersForm;
use App\Models\Event;
use App\Models\Folder;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;


/**
 * @property Event $event
 */
trait HandleFolder
{
    public FoldersForm $foldersForm;

    public function saveFolder(): void
    {
        $this->authorize('create', Folder::class);

        $this->foldersForm->validate();

        $this->foldersForm->save($this->event);

        session()->flash('success', __('flash-messages.folder-created'));

        $this->redirectRoute('events.show', ['event' => $this->event->id], navigate: true);
    }

    public function updateFolder(): void
    {
        $this->authorize('update', Folder::class);

        $this->foldersForm->validate();

        $this->foldersForm->update();

        session()->flash('success', __('flash-messages.folder-updated'));

        $this->redirectRoute('events.show', ['event' => $this->event->id], navigate: true);
    }

    #[On('delete-folder')]
    public function deleteFolder(int $id): void
    {
        $this->authorize('delete', Folder::class);

        $folder = Folder::findOrFail($id);

        if ($folder->files) {
            $disk = config('filesystems.default');
            $original_path = config('events.original_path') . '/' . $folder->path;

            foreach ($folder->files as $file) {
                $path = $original_path . '/' . $file->path;

                if (Storage::disk($disk)->exists($path)) {
                    Storage::disk($disk)->delete($path);
                }
            }
        }

        $folder->delete();

        session()->flash('success', __('flash-messages.folder-deleted'));

        $this->redirectRoute('events.show', ['event' => $this->event->id], navigate: true);
    }
}
