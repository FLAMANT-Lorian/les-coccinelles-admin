@props([
    'collection',
    'name',
    'field_name',
    'label',
    'required' => true,
    'search_wire' => '',
    'select_wire' => '',
    'form_property',
    'state',
    'enum'
])

@php
    $selected_item = null;
@endphp

<div {{ $attributes->merge(['class' => 'field w-full']) }}
     x-data="{ open: false }"
     @click.away="open = false; $refs.input.blur();"
     @keydown.window.escape="open = false; $refs.input.blur();">
    <div class="relative w-full flex flex-col gap-1">
        <label for="{{ $field_name }}"
               aria-label="{{ $label }}"
               @click="$refs.input.focus();"
               title="{{ $label }}">
            {{ $label }} @if($required)
                <strong> *</strong>
            @endif
        </label>

        <div class="result-container flex rounded-sm flex-row gap-1 flex-wrap cursor-pointer trans-all"
             @click="$refs.input.focus();">

            @if($form_property)

                @php
                    $selected_item = $enum::from($form_property);
                @endphp

                <button type="button"
                        wire:click="set('{{ $select_wire }}', null)"
                        class="group relative mr-2 z-10 text-sm px-2 py-0.5 bg-brown hover:bg-red text-white rounded flex items-center gap-1 trans-all">
                    <svg width="16"
                         height="16">
                        <use href="#cross-filter"></use>
                    </svg>
                    <span class="whitespace-nowrap">
                        {{ __('enums.' . $selected_item->value) }}
                    </span>
                </button>
            @endif

            <input
                @if($search_wire && $search_wire !== '')
                    wire:model.live="{{ $search_wire }}"
                @endif
                x-ref="input"
                @focus="open = true"
                :class="open ? 'rounded-b-none!' : ''"
                class="{{ $selected_item ? 'grow' : '' }}"
                placeholder="{{ $selected_item ? __('forms.change-option') : __('forms.select-option') }}"
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
        <div
            class="custom-select absolute top-[calc(100%+8px)] inset-x-0 z-20 bg-beige-light border border-brown overflow-hidden max-h-60 overflow-y-scroll"
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
                        <button type="button"
                                class="px-4 py-3 text-left flex justify-between hover:bg-beige-medium trans-all {{ ($select_wire && $form_property == $item->value) ? 'bg-beige-medium' : '' }}"
                                @click="
                                open = false;
                                $refs.input.blur();
                            "
                                wire:click="
                                set('{{ $select_wire }}', '{{ $item->value }}')
                                set('{{ $state }}', false)
                                set('{{ $search_wire }}', '')
                            ">
                    <span>{{ __('enums.' . $item->value) }}
                        @if($select_wire && $form_property == $item->value)
                            ({{ __('forms.selected') }})
                        @endif
                    </span>
                        </button>
                    @endforeach
                @else
                    <span class="mx-4 py-2 text-left">{{ __('forms.no_result') }}</span>
                @endif
            </div>
        </div>
    </div>

    @error($select_wire)
    <p class="absolute whitespace-nowrap -bottom-6 text-red text-sm font-medium">{!! $message !!}</p>
    @enderror
</div>
