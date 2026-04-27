<?php

use App\Enums\MessageTypes;
use App\Models\Message;
use App\Models\MessageType;
use App\Enums\MessageStatus;
use App\Traits\CloseModal;
use App\Traits\TableFilter;
use App\Traits\TableSelectedColumn;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

new class extends Component {

    use WithPagination;
    use TableFilter;
    use TableSelectedColumn;

    #[Url]
    public string $term = '';

    public string $filter_term = '';

    #[Url]
    public array $filter = [];

    public function mount(): void
    {
        $this->model = new Message();
    }

    #[Computed]
    public function getContactMessages()
    {
        $query = Message::whereHas('messageType', function (Builder $q) {
            $q->where('name', MessageTypes::contact->value);
        });

        if (!empty($this->term)) {
            $query->where(function (Builder $q) {
                $q->whereLike('email', '%' . $this->term . '%')
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$this->term%"]);
            });
        }

        if (!empty($this->filter)) {
            $query->whereIn('status', $this->filter);
        }

        if (!is_null($this->filter_column) && !is_null($this->filter_direction)) {
            $query->orderBy($this->filter_column, $this->filter_direction);
        }

        return $query->paginate(config('table.pagination-numbers'));
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

    public function deleteMessage(int $id): void
    {
        $message = Message::findOrFail($id);

        $message->delete();

        session()->flash('success', __('flash-messages.message-deleted'));

        $this->redirectRoute('messages', ['locale' => app()->getLocale()], navigate: true);
    }

};
?>

<div class="flex flex-col relative">
    {{-- FILTER --}}
    <div
        class="filter-container trans-all {{ $this->selectedColumn ? 'opacity-0 pointer-events-none' : 'opacity-100 pointer-events-auto' }}">
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
            :enum="true"
            :translation="true"
        />
    </div>

    <x-general.selected-column
        :array="$this->selectedColumn"
        :options="[
            'delete' => true,
            'markAsRead' => true,
            'markAsNotRead' => true
            ]"
    />

    @if($this->getContactMessages->isNotEmpty())
        {{-- TABLE --}}
        <table class="table" x-ref="contact_table">
            <x-pages.messages.tables.contact.table-head/>
            <x-pages.messages.tables.contact.table-body/>
        </table>

        <x-general.pagination
            :items="$this->getContactMessages"/>
    @else
        <x-general.no-results
            :term="$this->term"/>
    @endif

</div>
