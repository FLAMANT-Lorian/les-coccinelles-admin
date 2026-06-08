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
            <label for="selector-{{ $meeting->id }}"
                   class="sr-only">{{ __('tables.select_item') . $meeting->id }}</label>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.number') }}&nbsp;:</span>
            @can('update', Meeting::class)
                <button type="button"
                        class="underline-link after:bg-brown"
                        wire:click="$dispatch('open-modal', { modal: 'openEditModal', id: {{ $meeting->id }} })"
                        title="{{ __('pages/meetings.see-meeting') }}">
                    <span>{{ $meeting->id }}</span>
                </button>
            @else
                <span>{{ $meeting->id }}</span>
            @endcan
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
            <time datetime="{{ $date = formattedDate($meeting->date) }}">{{ $date }}</time>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.hour') }}&nbsp;:</span>
            <span>{{ Carbon::parse($meeting->hour)->format('H:i') }}</span>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.status') }}&nbsp;:</span>
            @if($meeting->date->startOfDay() >= Carbon::now()->startOfDay())
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
                    aria-label="{{ __('tables.fast-actions') . ' : ' . $meeting->id }}"
                    title="{{ __('tables.fast-actions') }}"
                    class="actions">
                <svg width="20" height="4" viewBox="0 0 20 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="#table-actions"></use>
                </svg>
                <span class="sr-only">{{ __('tables.fast-actions') . ' : ' . $meeting->id }}</span>
            </button>
            @canany(['update', 'delete'], Meeting::class)
                <div x-show="open" x-transition class="actions-table">
                    @can('update', Meeting::class)
                        <button type="button"
                                aria-label="{{ __('table.update') . ' : ' . $meeting->id }}"
                                title="{{ __('modals.updateMeeting') }}"
                                wire:click="$dispatch('open-modal', { modal: 'openEditModal', id: {{ $meeting->id }} })">
                            <span>{{ __('tables.update') }} <span class="sr-only">: {{ $meeting->id }}</span></span>
                        </button>
                    @endcan
                    @can('delete', Meeting::class)
                        <button type="button"
                                title="{{ __('modals.deleteMeeting') }}"
                                aria-label="{{ __('tables.delete') . ' : ' . $meeting->id }}"
                                wire:click="$dispatch('open-modal', { modal: 'openDeleteModal', id: {{ $meeting->id }} })">
                            <span>{{ __('tables.delete') }} <span class="sr-only">: {{ $meeting->id }}</span></span>
                        </button>
                    @endcan
                </div>
            @endcanany

            {{--ACTION MOBILES --}}
            @can('update', Meeting::class)
                <div class="actions-mobile">
                    <button type="button"
                            wire:click="$dispatch('open-modal', { modal: 'openEditModal', id: {{ $meeting->id }} })"
                            class="flex self-start flex-row gap-2 items-center px-4 py-3 border border-brown bg-brown text-white rounded-sm hover:bg-transparent hover:text-brown trans-all"
                            aria-label="{{ __('modals.updateMeeting') . ' : ' . $meeting->id }}"
                            title="{{ __('modals.updateMeeting') }}">
                        <span>{{ __('modals.updateMeeting') }} <span class="sr-only">: {{ $meeting->id }}</span></span>
                    </button>
                </div>
            @endcan
        </div>
    </td>
</tr>
