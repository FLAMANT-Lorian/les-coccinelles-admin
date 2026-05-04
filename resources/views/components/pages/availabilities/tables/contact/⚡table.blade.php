<?php

use App\Enums\MessageTypes;
use App\Models\Message;
use App\Enums\MessageStatus;
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

    #[Computed]
    public function getAvailabilityRequests()
    {
        $query = Message::where('type', MessageTypes::availability_request->value);

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

    #[On('deleteAvailabilityRequest')]
    public function deleteAvailabilityRequest(int $id): void
    {
        $this->authorize('delete', Message::class);

        $message = Message::findOrFail($id);

        $message->delete();

        session()->flash('success', __('flash-messages.availability-request-deleted'));

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
            name="availability_search"
            id="availability_search"
            :label="__('forms.search')"
            :placeholder="__('forms.search')"
        />

        <x-forms.input.custom-select-filter
            :collection="$this->getFilteredTerms"
            name="filter"
            wire="filter_term"
            id="availability_filter"
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
        :delete-permission="null"
    />

    @if($this->getAvailabilityRequests->isNotEmpty())
        {{-- TABLE --}}
        <table class="table" x-ref="table">
            <x-pages.availabilities.tables.contact.table-head/>
            <x-pages.availabilities.tables.contact.table-body/>
        </table>

        <x-general.pagination
            :items="$this->getAvailabilityRequests"/>
    @else
        <x-general.no-results
            :term="$this->term"/>
    @endif

</div>
