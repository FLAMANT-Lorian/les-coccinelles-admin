@php
    use App\ValueObjects\Money;
@endphp

@props([
    'utilityCost' => UtilityCost::class,
])

<tr x-data="{ open: false }"
    :class="open ? 'lg:[&_div]:bg-beige-medium' : ''">
    <td>
        <div>
            <input type="checkbox"
                   value="{{ $utilityCost->id }}"
                   id="selector-{{ $utilityCost->id }}"
                   wire:model.live="selectedColumn"
                   @change="$refs.table.querySelector(`thead .all-selector`).checked = false;">
            <label for="selector-{{ $utilityCost->id }}" class="sr-only">{{ __('tables.select_all') }}</label>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.type') }}&nbsp;:</span>
            @can('utilityCosts.update')
                <button type="button"
                        class="underline-link after:bg-brown"
                        wire:click="$dispatch('open-modal', {modal: 'updateUtilityCost', id: {{ $utilityCost->id }}})">
                    <span>{{ $utilityCost->type }}</span>
                </button>
            @else
                <span>{{ $utilityCost->type }}</span>
            @endcan
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.base_price') }}&nbsp;:</span>
            <span>{{ Money::fromCents($utilityCost->price)->format() }} / {{ $utilityCost->unit }}</span>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.status') }}&nbsp;:</span>
            <x-general.status :status="$utilityCost->status"/>
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
            @canany(['utilityCosts.update', 'utilityCosts.delete'])
                <div x-show="open" x-transition class="actions-table">
                    @can('utilityCosts.update')
                        <button type="button"
                                wire:click="$dispatch('open-modal', {modal: 'updateUtilityCost', id: {{ $utilityCost->id }}})"
                                title="{{ __('pages/hall.utility-costs.update-utility-cost') }}">
                            <span>{{ __('tables.update') }}</span>
                        </button>
                    @endcan
                    @can('utilityCosts.delete')
                        <button type="button"
                                wire:click="$dispatch('open-modal', {modal: 'deleteUtilityCost', id: {{ $utilityCost->id }}})"
                                title="{{ __('pages/hall.utility-costs.delete-utility-cost') }}">
                            <span>{{ __('tables.delete') }}</span>
                        </button>
                    @endcan
                </div>
            @endcanany

            {{-- ACTION MOBILES --}}
            @can('utilityCosts.update')
                <div class="actions-mobile">
                    <button type="button"
                            wire:click="$dispatch('open-modal', {modal: 'updateUtilityCost', id: {{ $utilityCost->id }}})"
                            class="flex self-start flex-row gap-2 items-center px-4 py-3 border border-brown bg-brown text-white rounded-sm hover:bg-transparent hover:text-brown trans-all"
                            title="{{ __('pages/hall.utility-costs.update-utility-cost') }}">
                        <span>{{ __('pages/hall.utility-costs.update-utility-cost') }}</span>
                    </button>
                </div>
            @endcan
        </div>
    </td>
</tr>
