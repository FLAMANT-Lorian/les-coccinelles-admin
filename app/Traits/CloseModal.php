<?php

namespace App\Traits;

trait CloseModal
{
    public function closeModal(): void
    {
        $this->dispatch('close-modal');
    }
}
