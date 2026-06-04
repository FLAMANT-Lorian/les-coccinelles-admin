@props([
    'type',
    'label',
    'name',
    'required' => false,
    'placeholder',
    'field_name',
    'wire' => '',
    'date_range' => false,
    'value' => ''
])

<div {{ $attributes->merge(['class' => 'relative field']) }}>
    <label for="{{ $field_name }}">
        {{ $label }}
        @if($required)
            <strong> *</strong>
        @endif
    </label>
    <input @if($wire && $wire !== '')
               wire:model="{{ $wire }}"
           @endif
           @if($value !== '')
               value="{{ $value }}"
           @endif
           @if($required)
               required
           @endif
           class="w-full min-h-12.5"
           id="{{ $field_name }}"
           type="{{ $type ?? 'text' }}"
           name="{{ $name }}"
           placeholder="{{ $placeholder ?? '' }}"
           autocomplete="off">

    @error($wire === '' ? $name : $wire)
    <p class="absolute whitespace-nowrap -bottom-6 text-red text-sm font-medium">{!! $message !!}</p>
    @enderror
</div>
