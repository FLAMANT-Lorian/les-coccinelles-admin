<?php

namespace App\Traits;

use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

trait DeleteEvent
{
    #[On('delete-event')]
    public function deleteEvent(int $id): void
    {
        $this->authorize('delete', Event::class);

        $event = Event::findOrFail($id)->load(['folders', 'folders.files', 'tasks']);

        $folders = $event->folders ?? null;
        $tasks = $event->tasks ?? null;

        if ($folders) {
            foreach ($folders as $folder) {
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
            }
        }

        if ($tasks) {
            foreach ($tasks as $task) {
                $task->delete();
            }
        }

        $event->delete();

        session()->flash('success', __('flash-messages.event-deleted'));

        $this->redirectRoute('events.index', navigate: true);
    }
}
