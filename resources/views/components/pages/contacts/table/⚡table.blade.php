<?php

use App\Enums\MemberCardStatus;
use App\Models\Contact;
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
    public function getContacts()
    {
        $query = Contact::query();

        if (!empty($this->term)) {
            $query->where(function (Builder $q) {
                $q->whereLike('email', "%$this->term%")
                    ->orWhereRaw('CONCAT(first_name, " ", last_name) LIKE ?', ["%$this->term%"]);
            });
        }

        if (!empty($this->filter)) {
            $query->where(function (Builder $q) {
                foreach ($this->filter as $option) {
                    $q->orWhere('member_card', MemberCardStatus::from($option)->toBoolean());
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
        $cases = MemberCardStatus::cases();

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
            name="contacts_search"
            id="contacts_search"
            :label="__('forms.search')"
            :placeholder="__('forms.search')"
        />

        <x-forms.input.custom-select-filter
            class="md:col-span-2 md:justify-self-start"
            :collection="$this->getFilteredTerms"
            name="filter"
            wire="filter_term"
            id="contacts_filter"
            :enum="true"
            :translation="true"
        />

        @can('create', Contact::class)
            <button type="button"
                    wire:click="$dispatch('open-modal', 'openCreateModal')"
                    title="{{ __('pages/hall.contacts.add-contact') }}"
                    aria-label="{{ __('pages/hall.contacts.add-contact') }}"
                    class="flex flex-row items-center gap-2.5 px-4 py-3 border border-brown bg-brown text-white group rounded-sm hover:bg-white hover:text-brown trans-all justify-center md:col-start-4 md:justify-self-end">
                {{ __('pages/hall.contacts.add-contact') }}
            </button>
        @endcan
    </div>

    <x-general.selected-column
        :array="$this->selectedColumn"
        :options="[
            'delete' => true,
            ]"
        :model="Contact::class"
    />

    @if($this->getContacts->isNotEmpty())
        {{-- TABLE --}}
        <p id="table-description" class="sr-only">
            {{ __('tables.captions.contacts') }}
        </p>

        <table class="table" aria-describedby="table-description" x-ref="table">
            <x-pages.contacts.table.table-head/>
            <x-pages.contacts.table.table-body/>
        </table>

        <x-general.pagination
            :items="$this->getContacts"/>
    @else
        <x-general.no-results
            :term="$this->term"/>
    @endif

</div>
