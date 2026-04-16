@props([
    'location',
    'label'
])

<a href="{{ $location }}"
   wire:navigate
   aria-label="{{ $label }}"
   title="{{ $label }}"
    {{ $attributes->merge(['class' => 'flex flex-row items-center gap-2.5 px-4 py-3 border border-brown bg-brown text-white group rounded-sm hover:bg-white hover:text-brown trans-all']) }}>
    <span>{{ $label }}</span>
    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
        <use href="#add"/>
    </svg>
</a>
