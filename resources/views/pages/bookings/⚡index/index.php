<?php

use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public bool $openDeleteModal = false;
    public bool $openDeleteSelection = false;
    public int $bookingToDelete;

    #[On('open-modal')]
    public function openModal(string $modal, int $id = null): void
    {
        if ($modal === 'openDeleteModal') {
            $this->bookingToDelete = $id;
            $this->openDeleteModal = true;
        } elseif ($modal === 'deleteSelection') {
            $this->openDeleteSelection = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->openDeleteModal = false;
        $this->openDeleteSelection = false;
    }
};
