@props([
    'type',
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
    <textarea @if($wire && $wire !== '')
                  wire:model="{{ $wire }}"
              @endif
              id="{{ $field_name }}"
              type="{{ $type ?? 'text' }}"
              name="{{ $name }}"
              placeholder="{{ $placeholder ?? '' }}"
              autocomplete="off"></textarea>

    @error($wire)
    <p class="absolute whitespace-nowrap -bottom-6 text-red text-sm font-medium">{!! $message !!}</p>
    @enderror
</div>
