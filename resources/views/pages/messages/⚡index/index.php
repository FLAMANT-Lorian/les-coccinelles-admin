<?php

use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {

    public bool $modalDeleteAll = false;
    public bool $modalMarkAsRead = false;

    #[On('openModal')]
    public function openModal(string $modal): void
    {
        if ($modal === 'deleteAll') {
            $this->modalDeleteAll = true;
        } elseif ($modal === 'markAsRead') {
            $this->modalMarkAsRead = true;
        }
    }

    #[On('closeModal')]
    public function closeModal(): void
    {
        $this->modalDeleteAll = false;
        $this->modalMarkAsRead = false;
    }
};
