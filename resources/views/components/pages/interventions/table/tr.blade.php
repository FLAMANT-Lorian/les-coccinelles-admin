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
            @can('interventions.update')
                <button type="button"
                        title="{{ __('modals.updateIntervention') }}"
                        class="underline-link after:bg-brown"
                        wire:click="$dispatch('open-modal', {modal: 'openUpdateModal', id: {{ $intervention->id }}})">
                    {{ $intervention->name }}
                </button>
            @else
                <span>{{ $intervention->name }}</span>
            @endcan
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
                @can('members.update')
                    <a href="{{ route('members.update', ['member' => $intervention->creator->id]) }}"
                       class="underline-link after:bg-brown"
                       wire:navigate
                       title="{{ __('pages/members.update-members') }}"
                       aria-label="{{ $intervention->creator->full_name }}">
                        <span>{{ $intervention->creator->full_name }}</span>
                    </a>
                @else
                    <span>{{ $intervention->creator->full_name }}</span>
                @endcan
            @else
                <span>–</span>
            @endif
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.assignee') }}&nbsp;:</span>
            @if($intervention->assignee)
                @can('members.update')
                    <a href="{{ route('members.update', ['member' => $intervention->assignee->id]) }}"
                       class="underline-link after:bg-brown"
                       wire:navigate
                       title="{{ __('pages/members.update-members') }}"
                       aria-label="{{ $intervention->assignee->full_name }}">
                        <span>{{ $intervention->assignee->full_name }}</span>
                    </a>
                @else
                    <span>{{ $intervention->assignee->full_name }}</span>
                @endcan
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
            @canany(['interventions.update', 'interventions.delete'])
                <div x-show="open" x-transition class="actions-table">
                    @can('interventions.update')
                        <button type="button"
                                wire:click="$dispatch('open-modal', {modal: 'openUpdateModal', id: {{ $intervention->id }}})"
                                title="{{ __('pages/hall.interventions.update-intervention') }}">
                            <span>{{ __('tables.update') }}</span>
                        </button>
                    @endcan
                    @can('interventions.delete')
                        <button type="button"
                                wire:click="$dispatch('open-modal', {modal: 'openDeleteModal', id: {{ $intervention->id }}})"
                                title="{{ __('pages/hall.interventions.delete-intervention') }}">
                            <span>{{ __('tables.delete') }}</span>
                        </button>
                    @endcan
                </div>
            @endcanany

            {{--ACTION MOBILES --}}
            @can('interventions.update')
                <div class="actions-mobile">
                    <button type="button"
                            wire:click="$dispatch('open-modal', {modal: 'openUpdateModal', id: {{ $intervention->id }}})"
                            class="flex self-start flex-row gap-2 items-center px-4 py-3 border border-brown bg-brown text-white rounded-sm hover:bg-transparent hover:text-brown trans-all"
                            title="{{ __('pages/hall.interventions.update-intervention') }}">
                        <span>{{ __('pages/hall.interventions.update-intervention') }}</span>
                    </button>
                </div>
            @endcan
        </div>
    </td>
</tr>
