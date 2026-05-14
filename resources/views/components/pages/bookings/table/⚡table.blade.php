<?php

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Traits\DeleteBooking;
use App\Traits\TableFilter;
use App\Traits\TableSelectedColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

new class extends Component {

    use WithPagination;
    use TableFilter;
    use TableSelectedColumn;
    use DeleteBooking;

    #[Computed]
    public function getBookings()
    {
        $query = Booking::with(['contact', 'hall_rate']);

        if (!empty($this->term)) {
            $term = $this->term;
            $query->where(function (Builder $q) use ($term) {
                $q->whereHas('contact', function (Builder $q) use ($term) {
                    $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$term%"]);
                });
            });
        }

        if (!empty($this->filter)) {
            $today = now()->format('Y-m-d');

            $query->where(function (Builder $q) use ($today) {
                if (in_array(BookingStatus::SOON->value, $this->filter)) {
                    $q->orWhereDate('start_date', '>', $today);
                }
                if (in_array(BookingStatus::PAST->value, $this->filter)) {
                    $q->orWhereDate('start_date', '<', $today);
                }
                if (in_array(BookingStatus::NOW->value, $this->filter)) {
                    $q->orWhereDate('start_date', '=', $today);
                }
            });
        }

        if (!is_null($this->filter_column) && !is_null($this->filter_direction)) {
            if (str_starts_with($this->filter_column, 'contact')) {
                $column = str_replace('contact.', '', $this->filter_column);

                $query->leftJoin('contacts', 'bookings.contact_id', 'contacts.id')
                    ->orderBy($column, $this->filter_direction)
                    ->select('bookings.*');
            } elseif (str_starts_with($this->filter_column, 'hall_rate')) {
                $column = str_replace('hall_rate.', '', $this->filter_column);

                $query->leftJoin('hall_rates', 'bookings.hall_rate_id', 'hall_rates.id')
                    ->orderBy($column, $this->filter_direction)
                    ->select('bookings.*');
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
        $cases = BookingStatus::cases();

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
            name="availability_search"
            id="availability_search"
            :label="__('forms.search')"
            :placeholder="__('forms.search')"
        />

        <x-forms.input.custom-select-filter
            class="md:col-span-2 md:justify-self-start"
            :collection="$this->getFilteredTerms"
            name="filter"
            wire="filter_term"
            id="availability_filter"
            :enum="true"
            :translation="true"
        />

        @can('create', Booking::class)
            <x-general.add-button
                class="justify-center md:col-start-4 md:justify-self-end"
                :location="route('bookings.create')"
                :label="__('pages/hall.bookings.add-booking')"
            />
        @endcan
    </div>

    <x-general.selected-column
        :array="$this->selectedColumn"
        :options="[
            'delete' => true
            ]"
        delete-permission="bookings.delete"
    />

    @if($this->getBookings->isNotEmpty())
        {{-- TABLE --}}
        <table class="table" x-ref="table">
            <x-pages.bookings.table.table-head/>
            <x-pages.bookings.table.table-body/>
        </table>

        <x-general.pagination
            :items="$this->getBookings"/>
    @else
        <x-general.no-results
            :term="$this->term"/>
    @endif

</div>
