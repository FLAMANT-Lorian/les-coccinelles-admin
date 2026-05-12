@props([
    'type',
    'label',
    'name',
    'required' => false,
    'placeholder',
    'field_name',
    'wire' => '',
    'disabled' => []
])

<div {{ $attributes->merge(['class' => 'relative field']) }}>
    <label for="{{ $field_name }}">
        {{ $label }}
        @if($required)
            <strong> *</strong>
        @endif
    </label>
    <div wire:ignore>
        <input @if($wire && $wire !== '')
                   wire:model="{{ $wire }}"
               @endif
               data-dates="{{ json_encode($disabled) }}"
               class="date-range w-full"
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
