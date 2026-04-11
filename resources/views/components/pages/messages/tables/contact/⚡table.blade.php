<?php

use App\Enums\MessageTypes;
use App\Models\Message;
use App\Models\MessageType;
use App\Enums\MessageStatus;
use App\Traits\TableFilter;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

new class extends Component {

    use WithPagination;
    use TableFilter;

    #[Url]
    public string $term = '';

    public string $filter_term = '';

    #[Url]
    public array $filter = [];

    #[Computed]
    public function getContactMessages()
    {
        $messages_type = MessageType::where('name', MessageTypes::contact->value)->first();

        if (!$messages_type) return;
        $query = $messages_type->messages();

        if (!empty($this->term)) {
            $query->where(function (Builder $query) {
                $query->whereLike('email', '%' . $this->term . '%')
                    ->orWhereLike('first_name', '%' . $this->term . '%')
                    ->orWhereLike('last_name', '%' . $this->term . '%')
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$this->term%"]);
            });
        }

        if (!empty($this->filter)) {
            $query->whereIn('status', $this->filter);
        }

        if (!is_null($this->filter_column) && !is_null($this->filter_direction)) {
            $query->orderBy($this->filter_column, $this->filter_direction);
        }

        return $query->with('messageType')
            ->paginate(9);
    }

    #[Computed]
    public function getFilteredTerms()
    {
        $cases = MessageStatus::cases();

        if (!empty($this->filter_term)) {
            return array_filter($cases, function ($case) {
                return str_contains(
                    strtolower(__('enums.' . $case->value)),
                    strtolower($this->filter_term)
                );
            });
        }
        return $cases;
    }
};
?>

<div class="flex flex-col">
    {{-- FILTER --}}
    <div class="filter-container">
        <x-forms.input.input-search
            wire="term"
            name="messages_search"
            id="messages_search"
            :label="__('forms.search')"
            :placeholder="__('forms.search')"
        />

        <x-forms.input.custom-select-filter
            :collection="$this->getFilteredTerms"
            name="filter"
            wire="filter_term"
            id="message_filter"
            :label="__('forms.filterStatus')"
            :placeholder="__('forms.filterStatus')"
        />
    </div>

    @if($this->getContactMessages->isNotEmpty())
        {{-- TABLE --}}
        <table class="table">
            <x-pages.messages.tables.contact.table-head/>
            <x-pages.messages.tables.contact.table-body/>
        </table>

        <x-general.pagination
            :items="$this->getContactMessages"/>
    @endif

</div>
