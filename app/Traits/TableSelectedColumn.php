<?php

namespace App\Traits;

use App\Enums\MessageStatus;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\On;

trait TableSelectedColumn
{
    public array $selectedColumn = [];
    public Model $model;

    #[On('deleteSelection')]
    public function deleteSelection(): void
    {
        foreach ($this->selectedColumn as $selection) {
            $item = $this->model::query()->findOrFail($selection);

            $item->delete();
        }
        $this->selectedColumn = [];
        $this->dispatch('close-modal');
    }

    #[On('markMessageSelectionAs')]
    public function markMessageSelectionAs(string $value): void
    {
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
        if (!in_array($value, enumToArray(MessageStatus::class))) {
            return;
        }
        $message = Message::findOrFail($id);

        if (!$message) return;

        $message->update([
            'status' => $value
        ]);
    }
}
