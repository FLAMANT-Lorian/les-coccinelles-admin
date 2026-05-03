<?php

use App\Jobs\ProcessUploadImages;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;

it('verifies if it\'s creates variants of the uploaded picture using the job', function () {
    Queue::fake();
    Storage::fake();

    $file_name = 'test.jpg';
    $original_path = config('avatar.original_path');
    $sizes = config('avatar.sizes');
    $path_to_variant = config('avatar.variant_path');

    $image = File::fake()->image($file_name);

    Storage::disk(config('filesystems.default'))->putFileAs(
        $original_path,
        $image,
        $file_name
    );

    $job = new ProcessUploadImages($file_name, 'avatar');
    $job->handle();

    Storage::assertExists($original_path . '/' . $file_name);

    foreach ($sizes as $size) {
        $variant_path = sprintf($path_to_variant, $size['width'], $size['height']);
        Storage::assertExists($variant_path . '/' . $file_name);
    }
});
