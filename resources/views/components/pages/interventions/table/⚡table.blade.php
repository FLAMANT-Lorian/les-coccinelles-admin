<?php

use App\Enums\InterventionStatus;
use App\Models\Intervention;
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
    public function getInterventions()
    {
        $query = Intervention::with(['assignee', 'creator']);

        if (!empty($this->term)) {
            $query->where(function (Builder $q) {
                $q->whereLike('name', '%' . "%$this->term%")
                    ->orWhereHas('creator', function (Builder $q) {
                        $q->whereLike('first_name', "%$this->term%")
                            ->orWhereLike('last_name', "%$this->term%")
                            ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$this->term%"]);
                    })
                    ->orWhereHas('assignee', function (Builder $q) {
                        $q->whereLike('first_name', "%$this->term%")
                            ->orWhereLike('last_name', "%$this->term%")
                            ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$this->term%"]);
                    });
            });
        }

        if (!empty($this->filter)) {
            $query->where(function (Builder $q) {
                $q->whereIn('status', $this->filter);
            });
        }

        if (!is_null($this->filter_column) && !is_null($this->filter_direction)) {
            if (str_starts_with($this->filter_column, 'creator')) {
                $column = str_replace('creator.', '', $this->filter_column);

                $query->leftJoin('users', 'interventions.created_by', 'users.id')
                    ->orderBy($column, $this->filter_direction)
                    ->select('interventions.*');
            } elseif (str_starts_with($this->filter_column, 'assignee')) {
                $column = str_replace('assignee.', '', $this->filter_column);

                $query->leftJoin('users', 'interventions.assigned_to', 'users.id')
                    ->orderBy($column, $this->filter_direction)
                    ->select('interventions.*');
            } else {
                $query->orderBy($this->filter_column, $this->filter_direction);
            }
        } else {
            $query->orderBy('updated_at', 'desc');
        }

        return $query->paginate(config('table.pagination-numbers'));
    }

    #[Computed]
    public function getFilteredTerms()
    {
        $cases = InterventionStatus::cases();

        if (!empty($this->filter_term)) {
            return array_filter($cases, function ($case) {
                return str_contains(
                    strtolower($case->value),
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
            name="members_search"
            id="members_search"
            :label="__('forms.search')"
            :placeholder="__('forms.search')"
        />

        <x-forms.input.custom-select-filter
            class="md:col-span-2 md:justify-self-start"
            :collection="$this->getFilteredTerms"
            name="filter"
            wire="filter_term"
            id="members_filter"
            :translation="true"
            :enum="true"
        />
    </div>

    <x-general.selected-column
        :array="$this->selectedColumn"
        :options="[
            'delete' => true,
            'markAsToDo' => true,
            'markAsDone' => true,
        ]"
        :deletePermission="null"
    />

    @if($this->getInterventions->isNotEmpty())
        {{-- TABLE --}}
        <table class="table" x-ref="table">
            <x-pages.interventions.table.table-head/>
            <x-pages.interventions.table.table-body/>
        </table>

        <x-general.pagination
            :items="$this->getInterventions"/>
    @else
        <x-general.no-results
            :term="$this->term"/>
    @endif

</div>
