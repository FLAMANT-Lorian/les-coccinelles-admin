<?php

use App\Models\AvailabilityRequest;
use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{
    public bool $modalDeleteAll = false;
    public bool $modalViewAvailabilityRequest = false;
    public bool $modalDeleteAvailabilityRequest = false;
    public AvailabilityRequest $availabilityRequestToSee;
    public ?int $availabilityRequestToDelete;


    #[On('open-modal')]
    public function openModal(string $modal, int $id = null): void
    {
        if ($modal === 'deleteSelection') {
            $this->modalDeleteAll = true;
        } elseif ($modal === 'viewAvailabilityRequest') {
            $availabilityRequest = AvailabilityRequest::findOrFail($id);

            if (!$availabilityRequest) return;

            $this->availabilityRequestToSee = $availabilityRequest;

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
