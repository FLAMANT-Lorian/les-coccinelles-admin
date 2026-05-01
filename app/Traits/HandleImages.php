<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

trait HandleImages
{
    public function storeAvatar(TemporaryUploadedFile $avatar): string
    {
        $file_name = uniqid() . '.' . config('avatar.image-type');

        Storage::disk(config('filesystems.default'))
            ->putFileAs(
                config('avatar.original_path'),
                $avatar,
                $file_name
            );

        return $file_name;
    }

    public function removeOldAvatar($file_name): void
    {
        $path = config('avatar.original_path') . $file_name;

        if (Storage::disk(config('filesystems.default'))->exists($path)) {
            Storage::disk(config('filesystems.default'))->delete($path);
        }
    }
}
