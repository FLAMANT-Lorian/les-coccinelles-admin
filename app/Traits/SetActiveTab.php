<?php

namespace App\Traits;

use Livewire\Attributes\Url;

trait SetActiveTab
{
    #[Url]
    public string $tab;

    public function setActiveTab($tab): void
    {
        $this->tab = $tab;
    }
}
