@props([
    'icon',
    'url',
    'label',
    'color'
])

<a href="{{ $url }}" class="text-brown flex items-center justify-center gap-4 p-4 hover:bg-transparent! trans-all border border-beige-dark/60 rounded-sm" style="background-color: {{ $color }}">
    <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <use href="{{ $icon }}"></use>
    </svg>
    <span class="text-base font-medium">{{ $label }}</span>
</a>
