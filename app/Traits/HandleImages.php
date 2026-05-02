<?php

namespace App\Traits;

use App\Jobs\ProcessUploadImages;
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

        ProcessUploadImages::dispatch($file_name, 'avatar')->onQueue('avatar');

        return $file_name;
    }

    public function removeOldAvatar($file_name): void
    {
        $original_path = config('avatar.original_path') . '/' . $file_name;
        $disk = config('filesystems.default');
        $sizes = config('avatar.sizes');

        if (Storage::disk($disk)->exists($original_path)) {
            Storage::disk($disk)->delete($original_path);
        }

        foreach ($sizes as $size) {
            $variant_path = sprintf(
                    config('avatar.variant_path'),
                    $size['width'],
                    $size['height']
                ) . '/' . $file_name;

            if (Storage::disk($disk)->exists($variant_path)) {
                Storage::disk($disk)->delete($variant_path);
            }
        }
    }
}
