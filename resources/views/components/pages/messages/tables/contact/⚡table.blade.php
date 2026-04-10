<?php

use App\Enums\MessageTypes;
use App\Models\Message;
use App\Models\MessageType;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

new class extends Component {

    use WithPagination;

    #[Url]
    public string $term = '';

    #[Computed]
    public function getContactMessages()
    {
        $messages_type = MessageType::where('name', MessageTypes::contact->value)->first();

        if (!$messages_type) return;
        $query = $messages_type->messages();

        if (!empty($this->term)) {
            $query->where(function (Builder $query) {
                $query->where('email', 'like', '%' . $this->term . '%')
                    ->orWhere('first_name', 'like', '%' . $this->term . '%')
                    ->orWhere('last_name', 'like', '%' . $this->term . '%')
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$this->term}%"]);
            });
        }

        return $query->orderBy('created_at', 'desc')
            ->with('messageType')
            ->paginate(9);
    }
};
?>

<div>
    {{-- FILTER --}}
    <div class="filter-container">
        <x-forms.input.input-search
            wire="term"
            name="messages_search"
            id="messages_search"
            :label="__('forms.search')"
            :placeholder="__('forms.search')"
        />
    </div>

    @if($this->getContactMessages->isNotEmpty())
        {{-- TABLE --}}
        <table class="table">
            <x-pages.messages.tables.contact.table-head/>
            <x-pages.messages.tables.contact.table-body/>
        </table>
        {{ $this->getContactMessages->links() }}
    @endif

</div>
