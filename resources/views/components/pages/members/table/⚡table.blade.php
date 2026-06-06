<?php

use App\Enums\MembersStatus;
use App\Models\User;
use App\Traits\DeleteMember;
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
    use DeleteMember;

    #[Computed]
    public function getMembers()
    {
        $query = User::query()->with(['roles']);

        if (!empty($this->term)) {
            $query->where(function (Builder $q) {
                $q->whereLike('email', '%' . $this->term . '%')
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$this->term%"]);
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
        $cases = MembersStatus::cases();

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
        @can('create', User::class)
            <x-general.add-button
                class="justify-center md:col-start-4 md:justify-self-end"
                :location="route('members.create')"
                :label="__('pages/members.add-members')"
            />
        @endcan
    </div>

    <x-general.selected-column
        :array="$this->selectedColumn"
        :options="[
            'delete' => true
        ]"
        :model="User::class"
    />

    @if($this->getMembers->isNotEmpty())
        {{-- TABLE --}}
        <p id="table-description" class="sr-only">
            {{ __('tables.captions.members') }}
        </p>

        <table class="table" aria-describedby="table-description" x-ref="table">
            <x-pages.members.table.table-head/>
            <x-pages.members.table.table-body/>
        </table>

        <x-general.pagination
            :items="$this->getMembers"/>
    @else
        <x-general.no-results
            :term="$this->term"/>
    @endif

</div>
