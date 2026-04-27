<?php

use App\Enums\MessageTypes;
use App\Enums\RoleMode;
use App\Models\Message;
use App\Models\MessageType;
use App\Enums\MessageStatus;
use App\Traits\DeleteRole;
use App\Traits\TableFilter;
use App\Traits\TableSelectedColumn;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Spatie\Permission\Models\Role;

new class extends Component {

    use WithPagination;
    use TableFilter;
    use TableSelectedColumn;
    use DeleteRole;

    #[Url]
    public string $term = '';

    public string $filter_term = '';

    #[Url]
    public array $filter = [];

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
            :location="route('roles.create', ['locale' => app()->getLocale()])"
            :label="__('pages/members.add-role')"
        />
    </div>

    <x-general.selected-column
        :array="$this->selectedColumn"
        :options="['delete' => true]"
        deleteAllModal="deleteAllRoles"
    />

    @if($this->getRoles->isNotEmpty())
        {{-- TABLE --}}
        <table class="table" x-ref="table">
            <x-pages.members.role.table.table-head/>
            <x-pages.members.role.table.table-body/>
        </table>

        <x-general.pagination
            :items="$this->getRoles"/>
    @else
        <x-general.no-results
            :term="$this->term"/>
    @endif

</div>
