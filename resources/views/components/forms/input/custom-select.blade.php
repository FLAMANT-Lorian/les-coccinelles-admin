@props([
    'collection',
    'name',
    'field_name',
    'label',
    'required' => true,
    'wire',
    'translation' => true,
    'enum' => true,
    'multiple' => true,
    'key' => '',
    'term' => '',
    'accessor' => '',
    'select_wire' => ''
])

<div {{ $attributes->merge(['class' => 'field w-full']) }} x-data="{ open: false }"
     @click.away="open = false;
         $refs.input.blur();"
     @keydown.window.escape="open = false;
         $refs.input.blur();">
    <div class="w-full flex flex-col gap-1">
        <label for="{{ $field_name }}"
               aria-label="{{ $label }}"
               @click="$refs.input.focus();"
               title="{{ $label }}">
            {{ $label }} @if($required)
                <strong>*</strong>
            @endif
        </label>
        <div class="result-container flex rounded-sm flex-row cursor-pointer trans-all"
             @click="$refs.input.focus();"
             :class="open ? 'rounded-b-none!' : ''">
            @if(!empty($this->selected[$key]))
                @foreach($this->selected[$key] as $idx => $item)
                    <button data-value="{{ $item }}"
                            type="button"
                            @click="
                                 open = false;
                                 $refs.input.blur();
                            "
                            @if($multiple)
                                wire:click="toggleSelection('{{ $key }}', '{{ $item }}')"
                            @else
                                wire:click="toggleSelection('{{ $key }}', '{{ $item }}')"
                            @endif
                            class="relative mr-2 z-10 text-sm px-2 py-0.5 bg-brown text-white rounded flex items-center gap-1">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <use href="#cross-filter"></use>
                        </svg>
                        <span class="whitespace-nowrap">{{ $translation ? __('enums.' . $item) : $item }}</span>
                    </button>
                @endforeach
            @endif
            <input
                @if($wire && $wire !== '')
                    wire:model.live="{{ $wire }}"
                @endif
                x-ref="input"
                @focus="open = true"
                :class="open ? 'rounded-b-none!' : ''"
                @if($multiple)
                    placeholder="@if(empty($this->selected[$key])) {{ __('forms.select-options') }} @else {{ __('forms.add-options') }} @endif"
                @else
                    placeholder="@if(empty($this->selected[$key])) {{ __('forms.select-option') }} @else {{ __('forms.change-option') }} @endif"
                @endif
                type="text"
                name="{{ $name }}"
                id="{{ $field_name }}">
            <svg :class="open ? 'rotate-90' : '-rotate-90'"
                 class="pointer-events-none cursor-pointer trans-all absolute right-4 top-1/2 -translate-y-1/2"
                 width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                <use href="#arrow-pagination"></use>
            </svg>
        </div>
    </div>
    <div
        class="custom-select  rounded-b-sm absolute top-full -mt-px inset-x-0 z-20 bg-beige-light border border-brown border-t-0 roundned-sm"
        x-show="open">
        <div class="flex flex-col divide-y divide-beige-medium open">
            @if(!empty($collection))
                @foreach($collection as $item)
                    <button type="button"
                            class="mx-4 py-3 text-left"
                            @click="open = false;
                        $refs.input.blur();"
                            @if($multiple)
                                wire:click="toggleSelection('{{ $key }}', '{{ $enum ? $item->value : $item[$accessor] }}')"
                            @else
                                wire:click="changeSelection('{{ $key }}', '{{ $enum ? $item->value : $item[$accessor] }}')"
                        @endif>
                        {{ ($translation ? __('enums.' . ($enum ? $item->value : $item[$accessor])) : ($enum ? $item->value : $item[$accessor])) . ' ' . (in_array(($enum ? $item->value : $item[$accessor]), $this->selected[$key]) ? '(' . __('forms.selected') . ')' : '') }}
                    </button>
                @endforeach
            @else
                <span class="mx-4 py-2 text-left">{{ __('forms.no_result') }}</span>
            @endif
        </div>
    </div>
    @error($select_wire)
    <p class="absolute -bottom-6 text-red text-sm font-medium">{!! $message !!}</p>
    @enderror
</div>
