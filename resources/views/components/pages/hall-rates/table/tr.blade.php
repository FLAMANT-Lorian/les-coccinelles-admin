@php use App\Models\HallRate;use App\ValueObjects\Money; @endphp
@props([
    'hallRate' => HallRate::class,
])

<tr x-data="{ open: false }"
    :class="open ? 'lg:[&_div]:bg-beige-medium' : ''">
    <td>
        <div>
            <input type="checkbox"
                   value="{{ $hallRate->id }}"
                   id="selector-{{ $hallRate->id }}"
                   wire:model.live="selectedColumn"
                   @change="$refs.table.querySelector(`thead .all-selector`).checked = false;">
            <label for="selector-{{ $hallRate->id }}" class="sr-only">{{ __('tables.select_item') . $hallRate->type }}</label>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.type') }}&nbsp;:</span>
            @can('update', HallRate::class)
                <button type="button"
                        wire:click="$dispatch('open-modal', {modal: 'openUpdateModal', id: {{ $hallRate->id }}})"
                        class="underline-link after:bg-brown">
                    {{ $hallRate->type }}
                </button>
            @else
                <span>{{ $hallRate->type }}</span>
            @endcan
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.base_price') }}&nbsp;:</span>
            <span>{{ Money::fromCents($hallRate->base_price)->format() }}</span>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.member_price') }}&nbsp;:</span>
            <span>{{ Money::fromCents($hallRate->member_price)->format() }}</span>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.deposit') }}&nbsp;:</span>
            <span>{{ Money::fromCents($hallRate->deposit)->format() }}</span>
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
                <span class="sr-only">{{ __('tables.fast-actions') . ' : ' . $hallRate->id }}</span>
            </button>
            @canany(['update', 'delete'], HallRate::class)
                <div x-show="open" x-transition class="actions-table">
                    @can('update', HallRate::class)
                        <button type="button"
                                title="{{ __('pages/hall.hall-rates.update-hall-rate') }}"
                                wire:click="$dispatch('open-modal', {modal: 'openUpdateModal', id: {{ $hallRate->id }}})">
                            <span>{{ __('tables.update') }}</span>
                        </button>
                    @endcan
                    @can('delete', HallRate::class)
                        <button type="button"
                                title="{{ __('pages/hall.hall-rates.delete-hall-rate') }}"
                                wire:click="$dispatch('open-modal', {modal: 'deleteHallRateModal', id: {{ $hallRate->id }}})">
                            <span>{{ __('tables.delete') }}</span>
                        </button>
                    @endcan
                </div>
            @endcan

            {{-- ACTION MOBILES --}}
            @can('update', HallRate::class)
                <div class="actions-mobile">
                    <button type="button"
                            class="flex self-start flex-row gap-2 items-center px-4 py-3 border border-brown bg-brown text-white rounded-sm hover:bg-transparent hover:text-brown trans-all"
                            title="{{ __('pages/hall.hall-rates.update-hall-rate') }}"
                            wire:click="$dispatch('open-modal', {modal: 'openUpdateModal', id: {{ $hallRate->id }}})">
                        <span>{{ __('pages/hall.hall-rates.update-hall-rate') }}</span>
                    </button>
                </div>
            @endcan
        </div>
    </td>
</tr>
