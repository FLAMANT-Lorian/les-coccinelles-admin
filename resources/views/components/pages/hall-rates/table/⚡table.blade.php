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
                $q->whereLike('type', '%' . $this->term . '%');
            });
        }

        if (!is_null($this->filter_column) && !is_null($this->filter_direction)) {
            $query->orderBy($this->filter_column, $this->filter_direction);
        } else {
            $query->orderBy('updated_at', 'desc');
        }

        return $query->paginate(config('table.pagination-numbers'));
    }

    #[On('delete-hall-rate')]
    public function deleteHallRate(int $id): void
    {
        $this->authorize('delete', HallRate::class);

        $hallRate = HallRate::findOrFail($id);

        $hallRate->delete();

        session()->flash('success', __('flash-messages.hall-rate-deleted'));

        $this->redirectRoute('hall-rates', navigate: true);
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

        @can('create', HallRate::class)
            <button type="button"
                    wire:click="$dispatch('open-modal', 'openCreateModal')"
                    class="flex flex-row items-center gap-2.5 px-4 py-3 border border-brown bg-brown text-white group rounded-sm hover:bg-white hover:text-brown trans-all justify-center md:col-start-4 md:justify-self-end">
                {{ __('pages/hall.hall-rates.add-hall-rate') }}
            </button>
        @endcan
    </div>

    <x-general.selected-column
        :array="$this->selectedColumn"
        :options="[
            'delete' => true,
            ]"
        :model="HallRate::class"
    />

    @if($this->getHallRates->isNotEmpty())
        {{-- TABLE --}}
        <p id="table-description" class="sr-only">
            {{ __('tables.captions.hall-rates') }}
        </p>

        <table class="table" aria-describedby="table-description" x-ref="table">
            <caption class="sr-only">
                {{ __('tables.description.hall-rates') }}
            </caption>
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
