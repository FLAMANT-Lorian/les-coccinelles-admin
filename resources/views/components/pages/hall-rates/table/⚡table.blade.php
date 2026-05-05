<?php

use App\Models\HallRate;
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
    public function getHallRates()
    {
        $query = HallRate::query();

        if (!empty($this->term)) {
            $query->where(function (Builder $q) {
                $q->whereLike('name', '%' . $this->term . '%');
            });
        }

        if (!is_null($this->filter_column) && !is_null($this->filter_direction)) {
            $query->orderBy($this->filter_column, $this->filter_direction);
        }

        return $query->paginate(config('table.pagination-numbers'));
    }
};
?>

<div class="flex flex-col relative">
    {{-- FILTER --}}
    <div
        class="filter-container trans-all {{ $this->selectedColumn ? 'opacity-0 pointer-events-none' : 'opacity-100 pointer-events-auto' }}">
        <x-forms.input.input-search
            wire="term"
            name="hall_rates_search"
            id="hall_rates_search"
            :label="__('forms.search')"
            :placeholder="__('forms.search')"
        />
    </div>

    <x-general.selected-column
        :array="$this->selectedColumn"
        :options="[
            'delete' => true,
            ]"
        :delete-permission="null"
    />

    @if($this->getHallRates->isNotEmpty())
        {{-- TABLE --}}
        <table class="table" x-ref="table">
            <x-pages.hall-rates.table.table-head/>
            <x-pages.hall-rates.table.table-body/>
        </table>

        <x-general.pagination
            :items="$this->getHallRates"/>
    @else
        <x-general.no-results
            :term="$this->term"/>
    @endif
</div>
