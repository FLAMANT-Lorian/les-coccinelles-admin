@props([
    'label',
    'name',
    'required' => false,
    'placeholder',
    'field_name',
    'wire' => ''
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
           @if($required)
               required
           @endif
               min="0"
           step="0.01"
           id="{{ $field_name }}"
           type="number"
           name="{{ $name }}"
           placeholder="{{ $placeholder ?? '' }}"
           autocomplete="off">

    @error($wire)
    <p class="absolute whitespace-nowrap -bottom-6 text-red text-sm font-medium">{!! $message !!}</p>
    @enderror
</div>
