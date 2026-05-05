<?php

use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public bool $createHallRateModalOpen = false;
    #[On('open-modal')]
    public function openModal($modal, $id = null): void
    {
        if ($modal === 'openCreateModal') {
            $this->createHallRateModalOpen = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->createHallRateModalOpen = false;
    }
};
