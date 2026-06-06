<?php

use App\Enums\MessageTypes;
use App\Enums\RoleMode;
use App\Models\Message;
use App\Enums\MessageStatus;
use App\Models\Role;
use App\Traits\DeleteRole;
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
    use DeleteRole;

    #[Computed]
    public function getRoles()
    {
        $query = Role::query()->with(['users']);

        if (!empty($this->term)) {
            $query->where(function (Builder $q) {
                $q->where('name', 'like', '%' . $this->term . '%');
            });
        }

        if (!empty($this->filter)) {
            $query->where(function (Builder $q) {
                foreach ($this->filter as $role) {
                    $q->orWhere('unique', RoleMode::from($role)->isSingle());
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
        $cases = RoleMode::cases();

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
            name="roles_search"
            id="roles_search"
            :label="__('forms.search')"
            :placeholder="__('forms.search')"
        />

        <x-forms.input.custom-select-filter
            class="md:col-span-2 md:justify-self-start"
            :collection="$this->getFilteredTerms"
            name="filter"
            wire="filter_term"
            id="role_filter"
            :translation="true"
            :enum="true"
        />
        @can('create', Role::class)
            <x-general.add-button
                class="justify-center md:col-start-4 md:justify-self-end"
                :location="route('roles.create')"
                :label="__('pages/roles.add-role')"
            />
        @endcan
    </div>

    <x-general.selected-column
        :array="$this->selectedColumn"
        :options="[
            'delete' => true
        ]"
        :model="Role::class"
    />

    @if($this->getRoles->isNotEmpty())
        {{-- TABLE --}}
        <p id="table-description" class="sr-only">
            {{ __('tables.captions.roles') }}
        </p>

        <table class="table" aria-describedby="table-description" x-ref="table">
            <caption class="sr-only">
                {{ __('tables.description.roles') }}
            </caption>
            <x-pages.roles.table.table-head/>
            <x-pages.roles.table.table-body/>
        </table>

        <x-general.pagination
            :items="$this->getRoles"/>
    @else
        <x-general.no-results
            :term="$this->term"/>
    @endif

</div>
