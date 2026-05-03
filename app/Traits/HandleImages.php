<?php

namespace App\Traits;

use App\Jobs\ProcessUploadImages;
use App\Models\User;
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

    public function removeOldAvatar($id): void
    {
        $member = User::findOrFail($id);
        $original_path = config('avatar.original_path') . '/' . $member->avatar_path;
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
                ) . '/' . $member->avatar_path;

            if (Storage::disk($disk)->exists($variant_path)) {
                Storage::disk($disk)->delete($variant_path);
            }
        }
    }

    public function storeDocument(TemporaryUploadedFile $document): string
    {
        $file_name = uniqid() . '.' . config('documents.image-type');

        Storage::disk(config('filesystems.default'))
            ->putFileAs(
                config('documents.original_path'),
                $document,
                $file_name
            );

        ProcessUploadImages::dispatch($file_name, 'documents')->onQueue('document');

        return $file_name;
    }

    public function removeOldDocument(string $document, ?int $id = null): void
    {
        $member = null;
        $documents = null;

        if ($id) {
            $member = User::findOrFail($id);
            $documents = $member->documents;
        }
        $disk = config('filesystems.default');
        $sizes = config('documents.sizes');
        $original_path = config('documents.original_path') . '/' . $document;

        if (Storage::disk($disk)->exists($original_path)) {
            Storage::disk($disk)->delete($original_path);
        }

        if ($member && $documents) {
            foreach ($documents as $db_document) {
                if ($db_document === $document) {
                    $original_path = config('documents.original_path') . '/' . $document;
                    $sizes = config('documents.sizes');

                    if (Storage::disk($disk)->exists($original_path)) {
                        Storage::disk($disk)->delete($original_path);
                    }

                    foreach ($sizes as $size) {
                        $variant_path = sprintf(
                                config('documents.variant_path'),
                                $size['width'],
                                $size['height']
                            ) . '/' . $document;
                        if (Storage::disk($disk)->exists($variant_path)) {
                            Storage::disk($disk)->delete($variant_path);
                        }
                    }

                    $documents = array_diff($documents, [$document]);
                    $member->documents = empty($documents) ? null : $documents;
                    $member->save();
                }
            }
        } else {
            foreach ($sizes as $size) {
                $variant_path = sprintf(
                        config('documents.variant_path'),
                        $size['width'],
                        $size['height']
                    ) . '/' . $document;
                if (Storage::disk($disk)->exists($variant_path)) {
                    Storage::disk($disk)->delete($variant_path);
                }
            }
        }
    }
}
