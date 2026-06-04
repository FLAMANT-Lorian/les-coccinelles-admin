<?php

use App\Models\Booking;
use App\Traits\DeleteMember;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {

    public Booking $booking;

    public bool $openDeleteModal = false;
    public int $bookingToDelete;

    public function mount(Booking $booking): void
    {
        $this->booking = $booking;
    }

    #[On('open-modal')]
    public function openModal(string $modal): void
    {
        if ($modal === 'openDeleteModal') {
            $this->openDeleteModal = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->openDeleteModal = false;
    }
};
