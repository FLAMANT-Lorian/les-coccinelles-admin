@php
    use App\Enums\BookingStatus;
    use App\Models\Booking;
    use Carbon\Carbon;
    /**
     * @var Booking $booking;
     */
@endphp

@props([
    'booking',
])

<tr x-data="{ open: false }"
    :class="open ? 'lg:[&_div]:bg-beige-medium' : ''">
    <td>
        <div>
            <input type="checkbox"
                   value="{{ $booking->id }}"
                   id="selector-{{ $booking->id }}"
                   wire:model.live="selectedColumn"
                   @change="$refs.table.querySelector(`thead .all-selector`).checked = false;">
            <label for="selector-{{ $booking->id }}" class="sr-only">{{ __('tables.select_all') }}</label>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.email') }}&nbsp;:</span>
            @can('update', Booking::class)
                <a href="{{ route('bookings.edit', ['booking' => $booking->id]) }}"
                   class="underline-link after:bg-brown"
                   title="{{ __('pages/hall.bookings-update.update-booking') }}"
                   aria-label="{{ $booking->contact->full_name }}">
                    {{ $booking->contact->full_name }}
                </a>
            @else
                {{ $booking->contact->full_name }}
            @endcanany
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.dates') }}&nbsp;:</span>
            @if(Carbon::parse($booking->bookingDate->start_date)->format('Y-m-d') === Carbon::parse($booking->bookingDate->end_date)->format('Y-m-d'))
                <time datetime="{{ $booking->bookingDate->start_date->format('Y-m-d') }}">
                    {{ formattedDate($booking->bookingDate->start_date) }}
                </time>
            @else
                <span>
                    <time datetime="{{ $booking->bookingDate->start_date->format('Y-m-d') }}">
                        {{ formattedDate($booking->bookingDate->start_date) }}
                    </time>
                    <span>{{ __('general.date-picker-format') }}</span>
                    <time datetime="{{ $booking->bookingDate->end_date->format('Y-m-d') }}">
                        {{ formattedDate($booking->bookingDate->end_date) }}
                    </time>
                </span>
            @endif
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.type') }}&nbsp;:</span>
            <span>{{ $booking->hall_rate->type }}</span>
        </div>
    </td>
    <td>
        <div>
            @php
                $start = Carbon::parse($booking->bookingDate->start_date);
                $end = Carbon::parse($booking->bookingDate->end_date);
            @endphp

            <span>{{ __('tables.status') }}&nbsp;:</span>
            @if($start->isFuture())
                <x-general.status :status="BookingStatus::SOON->value"/>
            @elseif($end->isPast() && !$end->isToday())
                <x-general.status :status="BookingStatus::PAST->value"/>
            @else
                <x-general.status :status="BookingStatus::NOW->value"/>
            @endif
        </div>
    </td>
    <td data-action>
        <div class="justify-end lg:relative">
            <button type="button"
                    @click="open = !open"
                    @click.away="open = false"
                    @keydown.window.escape="open = false"
                    :class="open ? 'lg:bg-beige-light' : ''"
                    class="actions">
                <svg width="20" height="4" viewBox="0 0 20 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="#table-actions"></use>
                </svg>
                <span class="sr-only">{{ __('tables.fast-actions') }}</span>
            </button>
            @canany(['update', 'delete'], Booking::class)
                <div x-show="open" x-transition class="actions-table">
                    @can('update', Booking::class)
                        <a href="{{ route('bookings.edit', ['booking' => $booking->id]) }}"
                           aria-label="{{ __('tables.update') }}"
                           title="{{ __('pages/hall.bookings-update.update-booking') }}">
                            {{ __('tables.update') }}
                        </a>
                    @endcan
                    @can('delete', Booking::class)
                        <button type="button"
                                wire:click="$dispatch('open-modal', { modal: 'openDeleteModal', id: {{ $booking->id }} })"
                                title="{{ __('pages/hall.bookings-update.delete-booking') }}"
                                aria-label="{{ __('tables.delete') }}">
                            {{ __('tables.delete') }}
                        </button>
                    @endcan
                </div>
            @endcan

            {{-- ACTION MOBILES --}}
            @can('update', Booking::class)
                <div class="actions-mobile">
                    <a class="flex self-start flex-row gap-2 items-center px-4 py-3 border border-brown bg-brown text-white rounded-sm hover:bg-transparent hover:text-brown trans-all"
                       href="{{ route('bookings.edit', ['booking' => $booking->id]) }}"
                       aria-label="{{ __('tables.update') }}"
                       title="{{ __('pages/hall.bookings-update.update-booking') }}">
                        <span class="text-left">{{ __('tables.update') }}</span>
                    </a>
                </div>
            @endcan
        </div>
    </td>
</tr>
