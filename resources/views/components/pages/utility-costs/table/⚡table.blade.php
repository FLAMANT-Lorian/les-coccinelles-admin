<?php

use App\Enums\UtilityCostsStatus;
use App\Models\UtilityCost;
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
    public function getUtilityCosts()
    {
        $query = UtilityCost::query();

        if (!empty($this->term)) {
            $query->where(function (Builder $q) {
                $q->whereLike('type', '%' . $this->term . '%');
            });
        }

        if (!empty($this->filter)) {
            $query->where(function (Builder $q) {
                $q->whereIn('status', $this->filter);
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
        $cases = UtilityCostsStatus::cases();

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
            name="utility_costs_search"
            id="utility_costs_search"
            :label="__('forms.search')"
            :placeholder="__('forms.search')"
        />

        <x-forms.input.custom-select-filter
            class="md:col-span-2 md:justify-self-start"
            :collection="$this->getFilteredTerms"
            name="filter"
            wire="filter_term"
            id="utility_costs_filter"
            :translation="true"
            :enum="true"/>

        @can('utilityCosts.create')
            <button type="button"
                    wire:click="$dispatch('open-modal', 'createUtilityCost')"
                    class="flex flex-row items-center gap-2.5 px-4 py-3 border border-brown bg-brown text-white group rounded-sm hover:bg-white hover:text-brown trans-all justify-center md:col-start-4 md:justify-self-end">
                {{ __('pages/hall.utility-costs.add-utility-cost') }}
            </button>
        @endcan
    </div>

    <x-general.selected-column
        :array="$this->selectedColumn"
        :options="[
            'delete' => true,
            ]"
        delete-permission="utilityCosts.delete"
    />

    @if($this->getUtilityCosts->isNotEmpty())
        {{-- TABLE --}}
        <table class="table" x-ref="table">
            <x-pages.utility-costs.table.table-head/>
            <x-pages.utility-costs.table.table-body/>
        </table>

        <x-general.pagination
            :items="$this->getUtilityCosts"/>
    @else
        <x-general.no-results
            :term="$this->term"/>
    @endif
</div>
