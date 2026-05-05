@php use App\ValueObjects\Money; @endphp
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
            <label for="selector-{{ $hallRate->id }}" class="sr-only">{{ __('tables.select_all') }}</label>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.type') }}&nbsp;:</span>
            <button type="button"
                    wire:click="$dispatch('open-modal', {modal: 'openUpdateModal', id: {{ $hallRate->id }}})"
                    class="underline-link after:bg-brown">
                {{ $hallRate->name }}
            </button>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.base_price') }}&nbsp;:</span>
            <span>{{ Money::fromCents($hallRate->base_price)->format() }} / {{ __('general.day') }}</span>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.member_price') }}&nbsp;:</span>
            <span>{{ Money::fromCents($hallRate->member_price)->format() }} / {{ __('general.day') }}</span>
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
            <div x-show="open" x-transition class="actions-table">
                <button type="button">
                    <span>{{ __('tables.delete') }}</span>
                </button>
            </div>

            {{-- ACTION MOBILES --}}
            <div class="actions-mobile">

            </div>
        </div>
    </td>
</tr>
