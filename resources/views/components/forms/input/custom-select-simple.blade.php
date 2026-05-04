@props([
    'collection',
    'name',
    'field_name',
    'label',
    'required' => true,
    'translation' => true,
    'enum' => true,
    'accessor' => '',
    'wire',
    'select_wire' => ''
])

@php
    $labels = [];

    foreach ($collection as $item) {
        $val = $enum ? $item->value : $item[$accessor];
        $labels[$val] = $translation ? __('enums.' . $val) : $val;
    }
@endphp

<div {{ $attributes->merge(['class' => 'field w-full']) }}
     x-data="{
        open: false,
        labels: @js($labels),
        value: $wire.entangle('{{ $select_wire }}'),

        toggle(val) {
            if (this.value === val) {
                this.value = null
            } else {
                this.value = val
            }
            this.open = false;
        }
     }"
     @click.away="open = false; $refs.input.blur();"
     @keydown.window.escape="open = false; $refs.input.blur();">
    <div class="w-full flex flex-col gap-1">
        <label for="{{ $field_name }}"
               aria-label="{{ $label }}"
               @click="$refs.input.focus();"
               title="{{ $label }}">
            {{ $label }} @if($required)
                <strong> *</strong>
            @endif
        </label>

        <div class="result-container flex rounded-sm flex-row cursor-pointer trans-all"
             @click="$refs.input.focus();">

            <template x-if="value">
                <button type="button"
                        class="group cursor-auto! relative mr-2 z-10 text-sm px-2 py-0.5 bg-brown has-[svg:hover]:bg-red text-white rounded flex items-center gap-1 trans-all">
                    <svg class="cursor-pointer group-hover:text-white"
                        @click.stop="toggle(value)"
                         width="16"
                         height="16">
                        <use href="#cross-filter"></use>
                    </svg>
                    <span class="whitespace-nowrap"
                          x-text="labels[value] ?? value">
                    </span>
                </button>
            </template>

            <input
                @if($wire && $wire !== '')
                    wire:model.live="{{ $wire }}"
                @endif
                x-ref="input"
                @focus="open = true"
                :class="open ? 'rounded-b-none!' : ''"
                :placeholder="value ? '{{ __('forms.change-option') }}' : '{{ __('forms.select-option') }}'"
                type="text"
                name="{{ $name }}"
                id="{{ $field_name }}"
                autocomplete="off"
            >

            <svg :class="open ? 'rotate-90' : '-rotate-90'"
                 class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2"
                 width="6" height="11">
                <use href="#arrow-pagination"></use>
            </svg>
        </div>
    </div>

    <div class="custom-select absolute top-[calc(100%+8px)] inset-x-0 z-20 bg-beige-light border border-brown overflow-hidden"
         x-transition:enter="transition ease-in-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in-out duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-1"
         x-show="open">
        <div class="flex flex-col divide-y divide-beige-medium shadow-xl">

            @if(!empty($collection))
                @foreach($collection as $item)
                    @php
                        $value = $enum ? $item->value : $item[$accessor];
                    @endphp
                    <button type="button"
                            class="px-4 py-3 text-left flex justify-between hover:bg-beige-medium trans-all"
                            @click="
                            toggle('{{ $value }}')
                            open = false;
                            $refs.input.blur();
                            "
                            wire:click="$wire.set('{!! $wire !!}', '')">

                    <span>{{ $translation ? __('enums.' . $value) : $value }}
                        <template x-if="value === '{{ $value }}'">
                            <span> ({!! __('forms.selected') !!})</span>
                        </template>
                    </span>
                    </button>
                @endforeach
            @else
                <span class="mx-4 py-2 text-left">{{ __('forms.no_result') }}</span>
            @endif
        </div>
    </div>

    @error($select_wire)
    <p class="absolute whitespace-nowrap -bottom-6 text-red text-sm font-medium">{!! $message !!}</p>
    @enderror
</div>
