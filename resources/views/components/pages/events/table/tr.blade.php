@php
    use App\Enums\EventStatus;
    use App\Models\Event;
    use Carbon\Carbon;
    /**
     * @var Event $event;
     */
@endphp

@props([
    'event'
])

<tr x-data="{ open: false }"
    :class="open ? 'lg:[&_div]:bg-beige-medium' : ''">
    <td>
        <div>
            <input type="checkbox"
                   value="{{ $event->id }}"
                   id="selector-{{ $event->id }}"
                   wire:model.live="selectedColumn"
                   @change="$refs.table.querySelector(`thead .all-selector`).checked = false;">
            <label for="selector-{{ $event->id }}" class="sr-only">{{ __('tables.select_item') . $event->id }}</label>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.name') }}&nbsp;:</span>
            @can('view', Event::class)
                <a href="{{ route('events.show', ['event' => $event->id]) }}"
                   class="underline-link after:bg-brown"
                   type="button">
                    {{ $event->name }}
                </a>
            @else
                <span>{{ $event->name }}</span>
            @endcan
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.events_dates') }}&nbsp;:</span>
            <span>
                <time datetime="{{ $event->start_date->format('Y-m-d') }}">
                    {{ formattedDate($event->start_date) }}
                </time>
                <span>{{ __('general.date-picker-format') }}</span>
                  <time datetime="{{ $event->end_date->format('Y-m-d') }}">
                    {{ formattedDate($event->end_date) }}
                </time>
            </span>
        </div>
    </td>
    <td>
        <div>
            @php
                $start = Carbon::parse($event->start_date);
                $end = Carbon::parse($event->end_date);
            @endphp

            <span>{{ __('tables.status') }}&nbsp;:</span>
            @if($start->isFuture())
                <x-general.status :status="EventStatus::SOON->value"/>
            @elseif($end->isPast() && !$end->isToday())
                <x-general.status :status="EventStatus::PAST->value"/>
            @else
                <x-general.status :status="EventStatus::NOW->value"/>
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
                    aria-label="{{ __('tables.fast-actions') . ' : ' . $event->id }}"
                    class="actions">
                <svg width="20" height="4" viewBox="0 0 20 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="#table-actions"></use>
                </svg>
                <span class="sr-only">{{ __('tables.fast-actions') }} <span class="sr-only"> : {{ $event->id }}</span></span>
            </button>
            @canany(['delete', 'update'], Event::class)
                <div x-show="open" x-transition class="actions-table">
                    @can('update', Event::class)
                        <button type="button"
                                aria-label="{{ __('pages/events.edit-event') . ' : ' . $event->id }}"
                                wire:click="$dispatch('open-modal', { modal: 'openUpdateModal', id: {{ $event->id }} })"
                                title="{{ __('pages/events.edit-event') }}">
                            <span>{{ __('tables.update') }} <span class="sr-only"> : {{ $event->id }}</span></span>
                        </button>
                    @endcan
                    @can('delete', Event::class)
                        <button type="button"
                                aria-label="{{ __('pages/events.delete-event') . ' : ' . $event->id }}"
                                wire:click="$dispatch('open-modal', { modal: 'openDeleteModal', id: {{ $event->id }} })"
                                title="{{ __('pages/events.delete-event') }}">
                            <span>{{ __('tables.delete') }} <span class="sr-only"> : {{ $event->id }}</span></span>
                        </button>
                    @endcan
                </div>
            @endcan

            {{-- ACTION MOBILES --}}
            @can('update', Event::class)
                <div class="actions-mobile">
                    <button type="button"
                            wire:click="$dispatch('open-modal', { modal: 'openUpdateModal', id: {{ $event->id }} })"
                            class="flex self-start flex-row gap-2 items-center px-4 py-3 border border-brown bg-brown text-white rounded-sm hover:bg-transparent hover:text-brown trans-all"
                            aria-label="{{ __('pages/events.edit-event') . ' : ' . $event->id }}"
                            title="{{ __('pages/events.edit-event') }}">
                        <span>{{ __('pages/events.edit-event') }} <span class="sr-only"> : {{ $event->id }}</span></span>
                    </button>
                </div>
            @endcan
        </div>
    </td>
</tr>
