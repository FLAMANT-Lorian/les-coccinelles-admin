@php
    use App\Enums\MeetingsStatus;use App\Enums\MessageStatus;
    use App\Models\Intervention;
    use App\Models\Meeting;
    use Carbon\Carbon;

    /** @var Meeting $meeting */
@endphp
@props([
    'meeting'
])

<tr x-data="{ open: false }"
    :class="open ? 'lg:[&_div]:bg-beige-medium' : ''">
    <td>
        <div>
            <input type="checkbox"
                   value="{{ $meeting->id }}"
                   id="selector-{{ $meeting->id }}"
                   wire:model.live="selectedColumn"
                   @change="$refs.table.querySelector(`thead .all-selector`).checked = false;">
            <label for="selector-{{ $meeting->id }}" class="sr-only">{{ __('tables.select_all') }}</label>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.number') }}&nbsp;:</span>
            <button type="button"
                    title="{{ __('pages/meetings.see-meeting') }}">
                <span>{{ $meeting->id }}</span>
            </button>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.address') }}&nbsp;:</span>
            <span>{{ $meeting->address }}</span>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.date') }}&nbsp;:</span>
            <span>{{ formattedDate($meeting->date) }}</span>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.hour') }}&nbsp;:</span>
            <span>{{ $meeting->hour->format('H:i') }}</span>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.status') }}&nbsp;:</span>
            @if($meeting->date > Carbon::now())
                <x-general.status :status="MeetingsStatus::SOON->value"/>
            @else
                <x-general.status :status="MeetingsStatus::PAST->value"/>
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
            {{--@canany()--}}
            <div x-show="open" x-transition class="actions-table">
                <button type="button">
                    <span>{{ __('tables.delete') }}</span>
                </button>
            </div>
            {{--@endcanany--}}

            {{--ACTION MOBILES --}}
            <div class="actions-mobile">

            </div>
        </div>
    </td>
</tr>
