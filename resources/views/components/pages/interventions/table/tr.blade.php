@php
    use App\Enums\MessageStatus;
    use App\Models\Intervention;
    /** @var Intervention $intervention */
@endphp
@props([
    'intervention'
])

<tr x-data="{ open: false }"
    :class="open ? 'lg:[&_div]:bg-beige-medium' : ''">
    <td>
        <div>
            <input type="checkbox"
                   value="{{ $intervention->id }}"
                   id="selector-{{ $intervention->id }}"
                   wire:model.live="selectedColumn"
                   @change="$refs.table.querySelector(`thead .all-selector`).checked = false;">
            <label for="selector-{{ $intervention->id }}" class="sr-only">{{ __('tables.select_all') }}</label>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.intervention-name') }}&nbsp;:</span>
            <span>{{ $intervention->name }}</span>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.deadline') }}&nbsp;:</span>
            <span>{{ formattedDate($intervention->deadline) }}</span>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.creator') }}&nbsp;:</span>
            @if($intervention->creator)
                <a href="{{ route('members.update', ['member' => $intervention->creator->id]) }}"
                   class="underline-link after:bg-brown"
                   wire:navigate
                   title="{{ __('pages/members.update-members') }}"
                   aria-label="{{ $intervention->creator->full_name }}">
                    <span>{{ $intervention->creator->full_name }}</span>
                </a>
            @else
                <span>–</span>
            @endif
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.assignee') }}&nbsp;:</span>
            @if($intervention->assignee)
                <a href="{{ route('members.update', ['member' => $intervention->assignee->id]) }}"
                   class="underline-link after:bg-brown"
                   wire:navigate
                   title="{{ __('pages/members.update-members') }}"
                   aria-label="{{ $intervention->assignee->full_name }}">
                    <span>{{ $intervention->assignee->full_name }}</span>
                </a>
            @else
                <span>–</span>
            @endif
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.status') }}&nbsp;:</span>
            <x-general.status :status="$intervention->status"/>
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
                    <span>{{ __('tables.update') }}</span>
                </button>
            </div>
            {{--@endcanany--}}

            {{--ACTION MOBILES --}}
            <div class="actions-mobile">

            </div>
        </div>
    </td>
</tr>
