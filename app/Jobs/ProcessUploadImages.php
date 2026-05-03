<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ProcessUploadImages implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $file_name, public string $config_path)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $sizes = config($this->config_path . '.sizes');
        $extension = config($this->config_path . '.image-type');
        $compression = config($this->config_path . '.image-compression');

        $image = Image::decode(
            Storage::disk(config('filesystems.default'))
                ->get(config($this->config_path . '.original_path') . '/' . $this->file_name)
        );

        foreach ($sizes as $size) {
            $variant = clone $image;

            $sized_image = $variant->cover(
                width: $size['width'],
                height: $size['height'],
            );

            $variant_path = sprintf(
                config($this->config_path . '.variant_path'),
                $size['width'],
                $size['height']
            );

            $full_path = $variant_path . '/' . $this->file_name;

            Storage::disk(config('filesystems.default'))->put(
                $full_path,
                $sized_image->encodeUsingFileExtension($extension, $compression)
            );
        }
    }
}
