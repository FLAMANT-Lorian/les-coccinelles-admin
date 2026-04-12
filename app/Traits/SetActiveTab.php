<?php

namespace App\Traits;

use Livewire\Attributes\Url;

trait SetActiveTab
{
    #[Url]
    public ?string $tab = null;
    public array $allowedTabs = [];
    public string $defaultTab = '';

    public function setActiveTab($tab): void
    {
        if (is_null($tab) || !in_array($tab, $this->allowedTabs, true)) {
            $this->tab = $this->defaultTab;
            return;
        }

        $this->tab = $tab;
    }

    public function checkAllowedTabs(array $tabs, string $defaultTab): void
    {
        $this->allowedTabs = $tabs;
        $this->defaultTab = $defaultTab;

        $this->setActiveTab($this->tab);
    }
}
