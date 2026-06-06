<?php


use App\Enums\MeetingsStatus;
use App\Models\Meeting;
use App\Traits\TableFilter;
use App\Traits\TableSelectedColumn;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {

    use WithPagination;
    use TableFilter;
    use TableSelectedColumn;

    #[Computed]
    public function getMeetings()
    {
        $query = Meeting::query();

        if (!empty($this->term)) {
            $query->where(function (Builder $q) {
                $q->whereLike('id', '%' . $this->term . "%")
                    ->orWhereLike('address', '%' . $this->term . '%');
            });
        }

        if (!empty($this->filter)) {
            $today = now()->format('Y-m-d');

            $query->where(function (Builder $q) use ($today) {
                if (in_array(MeetingsStatus::SOON->value, $this->filter)) {
                    $q->orWhereDate('date', '>', $today);
                }
                if (in_array(MeetingsStatus::PAST->value, $this->filter)) {
                    $q->orWhereDate('date', '<', $today);
                }
            });
        }

        if (!is_null($this->filter_column) && !is_null($this->filter_direction)) {
            $query->orderBy($this->filter_column, $this->filter_direction);
        } else {
            $query->orderBy('id', 'asc');
        }

        return $query->paginate(config('table.pagination-numbers'));
    }

    #[Computed]
    public function getFilteredTerms()
    {
        $cases = MeetingsStatus::cases();

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

<div class="flex flex-col relative">
    {{-- FILTER --}}
    <div
        class="filter-container trans-all {{ $this->selectedColumn ? 'opacity-0 pointer-events-none' : 'opacity-100 pointer-events-auto' }}">
        <x-forms.input.input-search
            wire="term"
            name="meetings_search"
            id="meetings_search"
            :label="__('forms.search')"
            :placeholder="__('forms.search')"
        />

        <x-forms.input.custom-select-filter
            class="md:col-span-2 md:justify-self-start"
            :collection="$this->getFilteredTerms"
            name="filter"
            wire="filter_term"
            id="meetings_filter"
            :translation="true"
            :enum="true"
        />

        @can('create', Meeting::class)
            <button type="button"
                    title="{{ __('pages/meetings.add-meeting') }}"
                    wire:click="$dispatch('open-modal', 'openCreateModal')"
                    class="flex flex-row items-center gap-2.5 px-4 py-3 border border-brown bg-brown text-white group rounded-sm hover:bg-white hover:text-brown trans-all justify-center md:col-start-4 md:justify-self-end">
                {{ __('pages/meetings.add-meeting') }}
            </button>
        @endcan
    </div>

    <x-general.selected-column
        :array="$this->selectedColumn"
        :options="[
            'delete' => true,
        ]"
        :model="Meeting::class"
    />

    @if($this->getMeetings->isNotEmpty())
        {{-- TABLE --}}
        <<p id="table-description" class="sr-only">
            {{ __('tables.captions.meetings') }}
        </p>

        <table class="table" aria-describedby="table-description" x-ref="table">
            <x-pages.meetings.table.table-head/>
            <x-pages.meetings.table.table-body/>
        </table>

        <x-general.pagination
            :items="$this->getMeetings"/>
    @else
        <x-general.no-results
            :term="$this->term"/>
    @endif

</div>
