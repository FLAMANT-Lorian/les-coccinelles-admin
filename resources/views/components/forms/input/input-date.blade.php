@props([
    'label',
    'name',
    'required' => false,
    'field_name',
    'wire' => '',
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
           id="{{ $field_name }}"
           type="date"
           name="{{ $name }}"
           autocomplete="off">

    @error($wire)
    <p class="absolute whitespace-nowrap -bottom-6 text-red text-sm font-medium">{!! $message !!}</p>
    @enderror
</div>
