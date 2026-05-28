<?php

namespace App\Traits;

use App\Models\Folder;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

/**
 * @property Folder $folder
 */
trait HandleFiles
{
    public array $files;

    public function updatedFiles(): void
    {
        $disk = config('filesystems.default');
        $original_path = config('events.original_path') . '/' . $this->folder->path;

        if (!empty($this->files)) {
            foreach ($this->files as $file) {

                $file_name = $file->getClientOriginalName();
                $path = uniqid('file-') . $file->getClientOriginalExtension();

                Storage::disk($disk)
                    ->putFileAs(
                        $original_path,
                        $file,
                        $path
                    );

                $this->folder->files()
                    ->create([
                        'name' => $file_name,
                        'path' => $path
                    ]);
            }
        }

        $this->files = [];
    }

    #[On('delete-file')]
    public function deleteFile(int $id): void
    {
        $disk = config('filesystems.default');
        $original_path = config('events.original_path') . '/' . $this->folder->path;

        $file = $this->folder->files()->findOrFail($id);

        $path = $original_path . '/' . $file->path;

        if (Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
        }

        $file->delete();
    }
}
