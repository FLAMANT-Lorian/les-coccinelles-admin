<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait CleanLivewireTMPFolder
{
    public function cleanLivewireTMPFolder(): void
    {
        $livewireTMPFolder = storage_path('app/private/livewire-tmp');
        if (File::exists($livewireTMPFolder)) {
            File::cleanDirectory($livewireTMPFolder);
        }
    }
}
