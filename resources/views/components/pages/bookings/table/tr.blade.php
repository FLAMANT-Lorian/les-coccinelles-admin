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
            <a href="{{ route('bookings.update', ['booking' => $booking->id]) }}"
               class="underline-link after:bg-brown"
               title="{{ __('pages/hall.bookings-update.update-booking') }}"
               aria-label="{{ $booking->contact->full_name }}">
                {{ $booking->contact->full_name }}
            </a>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.start_date') }}&nbsp;:</span>
            <span>{{ formattedDate($booking->start_date) . __('general.date-picker-format') . formattedDate($booking->end_date) }}</span>
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
            <span>{{ __('tables.status') }}&nbsp;:</span>
            @if(Carbon::parse($booking->start_date)->format('Y-m-d') > Carbon::now()->format('Y-m-d'))
                <x-general.status :status="BookingStatus::SOON->value"/>
            @elseif(Carbon::parse($booking->start_date)->format('Y-m-d') < Carbon::now()->format('Y-m-d'))
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
            @canany(['availabilities.delete', 'availabilities.update'])
                <div x-show="open" x-transition class="actions-table">
                    <button type="button">
                        <span>{{ __('tables.update') }}</span>
                    </button>
                </div>
            @endcan

            {{-- ACTION MOBILES --}}
            <div class="actions-mobile">
            </div>
        </div>
    </td>
</tr>
