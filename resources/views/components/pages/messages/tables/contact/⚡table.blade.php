<?php

use App\Enums\MessageTypes;
use App\Models\Message;
use App\Models\MessageType;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {

    use WithPagination;

    #[Computed]
    public function getContactMessages()
    {
        $messages_type = MessageType::where('name', MessageTypes::contact->value)->first();

        if (!$messages_type) return;

        return $messages_type->messages()
            ->orderBy('created_at', 'desc')
            ->with('messageType')
            ->paginate(9);
    }
};
?>

<table class="table">
    <x-pages.messages.tables.contact.table-head/>
    <x-pages.messages.tables.contact.table-body/>
</table>
