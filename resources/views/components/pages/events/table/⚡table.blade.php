<?php

use App\Enums\EventStatus;
use App\Models\Event;
use App\Traits\TableFilter;
use App\Traits\TableSelectedColumn;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

new class extends Component {

    use WithPagination;
    use TableFilter;
    use TableSelectedColumn;

    #[Computed]
    public function getEvents()
    {
        $query = Event::query();

        if (!empty($this->term)) {
            $query->where(function (Builder $q) {
                $q->whereLike('name', "%$this->term%");
            });
        }

        if (!empty($this->filter)) {
            $query->where(function (Builder $q) {
                $now = now()->format('Y-m-d H:i:s');

                if (in_array(EventStatus::SOON->value, $this->filter)) {
                    $q->orWhereDate('start_date', '>', $now);
                }
                if (in_array(EventStatus::PAST->value, $this->filter)) {
                    $q->orWhereDate('end_date', '<', $now);
                }
                if (in_array(EventStatus::NOW->value, $this->filter)) {
                    $q->where(function (Builder $q) use ($now) {
                        $q->where('start_date', '<=', $now)
                            ->where('end_date', '>=', $now);
                    });
                }
            });
        }

        if (!is_null($this->filter_column) && !is_null($this->filter_direction)) {
            $query->orderBy($this->filter_column, $this->filter_direction);
        } else {
            $query->orderBy('updated_at', 'desc');
        }

        return $query->paginate(config('table.pagination-numbers'));
    }

    #[Computed]
    public function getFilteredTerms()
    {
        $cases = EventStatus::cases();

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
            name="events_search"
            id="events_search"
            :label="__('forms.search')"
            :placeholder="__('forms.search')"
        />

        <x-forms.input.custom-select-filter
            class="md:col-span-2 md:justify-self-start"
            :collection="$this->getFilteredTerms"
            name="filter"
            wire="filter_term"
            id="events_filter"
            :enum="true"
            :translation="true"
        />
    </div>

    <x-general.selected-column
        :array="$this->selectedColumn"
        :options="[
            'delete' => true,
            ]"
        :model="Event::class"
    />

    @if($this->getEvents->isNotEmpty())
        {{-- TABLE --}}
        <table class="table" x-ref="table">
            <x-pages.events.table.table-head/>
            <x-pages.events.table.table-body/>
        </table>

        <x-general.pagination
            :items="$this->getEvents"/>
    @else
        <x-general.no-results
            :term="$this->term"/>
    @endif

</div>
