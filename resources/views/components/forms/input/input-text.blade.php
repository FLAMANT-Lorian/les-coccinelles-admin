@props([
    'type',
    'label',
    'name',
    'required' => false,
    'placeholder',
    'field_name',
    'value',
])

<div {{ $attributes->merge(['class' => 'relative field']) }}>
    <label for="{{ $field_name }}">
        {{ $label }}
        @if($required)
            <strong> *</strong>
        @endif
    </label>
    <input id="{{ $field_name }}"
           type="{{ $type ?? 'text' }}"
           name="{{ $name }}"
           placeholder="{{ $placeholder ?? '' }}"
           value="{{ old($name) ?? '' }}"
           autocomplete="off">

    @error($name)
    <p class="absolute -bottom-6 text-red text-sm font-medium">{!! $message !!}</p>
    @enderror
</div>
