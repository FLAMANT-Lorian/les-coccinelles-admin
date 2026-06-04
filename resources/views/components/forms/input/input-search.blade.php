@props([
    'wire' => '',
    'name',
    'id',
    'label',
    'placeholder',
])

<div {!! $attributes->merge(['class' => 'field self-start']) !!}>
    <label class="sr-only" for="{!! $id !!}">
        {!! $label !!}
    </label>

    <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
         xmlns="http://www.w3.org/2000/svg"
         class="absolute text-brown left-4 top-1/2 -translate-y-1/2">
        <use href="#search"/>
    </svg>
    <input
        @if($wire !== '')
            wire:model.live="{{ $wire }}"
        @endif
        class="pl-15! w-full"
        placeholder="{!! $placeholder ?? '' !!}"
        type="text"
        name="{!! $name !!}"
        id="{!! $id !!}"
        autocomplete="off">
</div>
