@props([
    'type',
    'label',
    'name',
    'required' => false,
    'placeholder',
    'field_name',
    'wire' => '',
    'date_range' => false,
    'ignore' => false,
    'value' => ''
])

<div {{ $attributes->merge(['class' => 'relative field']) }}>
    <label for="{{ $field_name }}">
        {{ $label }}
        @if($required)
            <strong> *</strong>
        @endif
    </label>
    <div @if($ignore) wire:ignore @endif>
        <input @if($wire && $wire !== '')
                   wire:model="{{ $wire }}"
               @endif
               @if($value !== '')
                   value="{{ $value }}"
               @endif
               class="{{ $date_range ? 'date-range' : '' }} w-full"
               id="{{ $field_name }}"
               type="{{ $type ?? 'text' }}"
               name="{{ $name }}"
               placeholder="{{ $placeholder ?? '' }}"
               autocomplete="off">
    </div>

    @error($wire === '' ? $name : $wire)
    <p class="absolute whitespace-nowrap -bottom-6 text-red text-sm font-medium">{!! $message !!}</p>
    @enderror
</div>
