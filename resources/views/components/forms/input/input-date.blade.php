@props([
    'label',
    'name',
    'required' => false,
    'placeholder',
    'field_name',
    'wire' => '',
    'disabled' => [],
    'date_range' => null,
    'type' => null
])

<div {{ $attributes->merge(['class' => 'relative field']) }}>
    <label for="{{ $field_name }}">
        {{ $label }}
        @if($required)
            <strong> *</strong>
        @endif
    </label>
    <div wire:ignore class="{{ $date_range ? 'range' : 'simple' }}">
        <input @if($wire && $wire !== '')
                   wire:model="{{ $wire }}"
               @endif
               @if($date_range)
                   data-dates="{{ json_encode($disabled) }}"
               @endif
               @if($required)
                   required
               @endif
               @if($date_range)
                   data-range
               @else
                   data-simple
               @endif
               class="{{ $date_range ? 'date-range-picker' : 'date-picker' }} w-full"
               id="{{ $field_name }}"
               type="{{ $type ?? 'text' }}"
               name="{{ $name }}"
               placeholder="{{ $placeholder ?? '' }}"
               autocomplete="off">
    </div>

    @error($wire)
    <p class="absolute whitespace-nowrap -bottom-6 text-red text-sm font-medium">{!! $message !!}</p>
    @enderror
</div>
