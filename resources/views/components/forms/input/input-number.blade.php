@props([
    'label',
    'name',
    'required' => false,
    'placeholder',
    'field_name',
    'wire' => '',
    'min' => false,
    'max' => false,
    'step' => false
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
           @if($min)
               min="{{ $min }}"
           @endif
           @if($max)
               max="{{ $max }}"
           @endif
           @if($required)
               required
           @endif
           @if($step)
               step="{{ $step }}"
           @endif
           id="{{ $field_name }}"
           type="number"
           name="{{ $name }}"
           placeholder="{{ $placeholder ?? '' }}"
           autocomplete="off">

    @error($wire)
    <p class="absolute whitespace-nowrap -bottom-6 text-red text-sm font-medium">{!! $message !!}</p>
    @enderror
</div>
