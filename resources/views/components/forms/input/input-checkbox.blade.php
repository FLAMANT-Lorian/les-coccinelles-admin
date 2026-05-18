@props([
    'label',
    'name',
    'required' => false,
    'placeholder',
    'field_name',
    'wire' => '',
])

<div {{ $attributes->merge(['class' => 'relative checkbox-field']) }}>
    <input @if($wire && $wire !== '')
               wire:model="{{ $wire }}"
           @endif
           class="w-full"
           id="{{ $field_name }}"
           type="checkbox"
           name="{{ $name }}"
           autocomplete="off">
    <label for="{{ $field_name }}">
        {{ $label }}
    </label>
</div>
