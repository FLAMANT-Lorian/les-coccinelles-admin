<?php

use App\Enums\MessageTypes;
use App\Models\MessageType;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    #[Computed]
    public function getBookingMessages()
    {
        $messages_type = MessageType::where('name', MessageTypes::booking->value)->first();

        if (!$messages_type) return;

        return $messages_type->messages()
            ->with('messageType')
            ->orderBy('created_at', 'desc')
            ->paginate(9);
    }
};
?>

<table class="table">
    <x-pages.messages.tables.booking.table-head/>
    <x-pages.messages.tables.booking.table-body/>
</table>
