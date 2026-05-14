<?php

namespace App\Traits;

use App\Enums\MessageStatus;
use App\Models\AvailabilityRequest;
use App\Models\Message;
use App\Models\User;
use Livewire\Attributes\On;
use Spatie\Permission\Models\Role;

trait TableSelectedColumn
{
    use DeleteSelection;

    public array $selectedColumn = [];

    #[On('markMessageSelectionAs')]
    public function markMessageSelectionAs(string $value): void
    {
        $this->authorize('update', Message::class);

        if (!in_array($value, enumToArray(MessageStatus::class))) {
            $this->selectedColumn = [];
            return;
        }

        foreach ($this->selectedColumn as $id) {
            $message = Message::findOrFail($id);

            if (!$message) return;

            $message->update([
                'status' => $value
            ]);
        }
    }

    #[On('markMessageAs')]
    public function markMessageAs(string $value, int $id): void
    {
        if (!auth()->user()->can('update', Message::class)) {
            return;
        }

        if (!in_array($value, enumToArray(MessageStatus::class))) {
            return;
        }
        $message = Message::findOrFail($id);

        if (!$message) return;

        $message->update([
            'status' => $value
        ]);
    }

    #[On('markAvailabilityRequestsSelectionAs')]
    public function markAvailabilityRequestsSelectionAs(string $value): void
    {
        $this->authorize('update', AvailabilityRequest::class);

        if (!in_array($value, enumToArray(MessageStatus::class))) {
            $this->selectedColumn = [];
            return;
        }

        foreach ($this->selectedColumn as $id) {
            $availabilityRequest = AvailabilityRequest::findOrFail($id);

            if (!$availabilityRequest) return;

            $availabilityRequest->update([
                'status' => $value
            ]);
        }
    }

    #[On('markAvailabilityRequestAs')]
    public function markAvailabilityRequestAs(string $value, int $id): void
    {
        if (!auth()->user()->can('update', AvailabilityRequest::class)) {
            return;
        }

        if (!in_array($value, enumToArray(MessageStatus::class))) {
            return;
        }
        $availabilityRequest = AvailabilityRequest::findOrFail($id);

        if (!$availabilityRequest) return;

        $availabilityRequest->update([
            'status' => $value
        ]);
    }
}
