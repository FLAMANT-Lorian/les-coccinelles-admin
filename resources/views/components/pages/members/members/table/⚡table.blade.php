<?php

use App\Enums\MembersStatus;
use App\Models\User;
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
        $this->model = new User();
    }

    #[Computed]
    public function getMembers()
    {
        $query = User::query();

        if (!empty($this->term)) {
            $query->where(function (Builder $q) {
                $q->whereLike('email', '%' . $this->term . '%')
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$this->term%"]);
            });
        }

        if (!empty($this->filter)) {
            $query->where(function (Builder $q) {
                foreach ($this->filter as $status) {
                    $q->orWhere('status', MembersStatus::from($status));
                }
            });
        }

        if (!is_null($this->filter_column) && !is_null($this->filter_direction)) {
            $query->orderBy($this->filter_column, $this->filter_direction);
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
            name="messages_search"
            id="messages_search"
            :label="__('forms.search')"
            :placeholder="__('forms.search')"
        />

        <x-forms.input.custom-select-filter
            :collection="$this->getFilteredTerms"
            name="filter"
            wire="filter_term"
            id="role_filter"
            :translation="true"
            :enum="true"
        />
        <x-general.add-button
            class="justify-center md:col-span-2 md:justify-self-end"
            :location="route('members.create', ['locale' => app()->getLocale()])"
            :label="__('pages/members.add-members')"
        />
    </div>

    <x-general.selected-column
        :array="$this->selectedColumn"
        :options="['delete' => true]"
    />

    @if($this->getMembers->isNotEmpty())
        {{-- TABLE --}}
        <table class="table" x-ref="table">
            <x-pages.members.members.table.table-head/>
            <x-pages.members.members.table.table-body/>
        </table>

        <x-general.pagination
            :items="$this->getMembers"/>
    @else
        <x-general.no-results
            :term="$this->term"/>
    @endif

</div>
