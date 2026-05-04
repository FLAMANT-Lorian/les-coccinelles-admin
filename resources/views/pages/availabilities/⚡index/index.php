<?php

use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{
    public bool $modalDeleteAll = false;
    public bool $modalViewAvailabilityRequest = false;
    public bool $modalDeleteAvailabilityRequest = false;
    public Message $availabilityRequestToSee;
    public ?int $availabilityRequestToDelete;


    #[On('open-modal')]
    public function openModal(string $modal, int $id = null): void
    {
        if ($modal === 'deleteAll') {
            $this->modalDeleteAll = true;
        } elseif ($modal === 'viewAvailabilityRequest') {
            $message = Message::findOrFail($id);

            if (!$message) return;

            $this->availabilityRequestToSee = $message;

            $this->modalViewAvailabilityRequest = true;
        } elseif ($modal === 'deleteAvailabilityRequest') {
            $this->availabilityRequestToDelete = $id;

            $this->modalDeleteAvailabilityRequest = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->modalDeleteAll = false;
        $this->modalViewAvailabilityRequest = false;
        $this->modalDeleteAvailabilityRequest = false;
    }
};
