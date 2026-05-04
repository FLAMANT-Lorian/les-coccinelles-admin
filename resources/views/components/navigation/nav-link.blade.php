@props([
    'label',
    'route',
    'icon',
    'wire_current_exact' => null
])
<a wire:navigate
   @if($wire_current_exact)
       wire:current.exact="bg-red text-white"
   @else
       wire:current="bg-red text-white"
   @endif
   {{ $attributes->merge(['class' => 'paragraph btn text-brown hover:bg-red hover:text-white focus:bg-red focus:text-white']) }}
   aria-label="{{ $label }}"
   title="{{ __('navigation/navigation.got_to_title') . $label }}"
   href="{{ $route }}">
    <svg class="min-w-6 min-h-6" width="24" height="24" viewBox="0 0 24 24" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <use href="#{{ $icon }}"></use>
    </svg>
    <span>{{ $label }}</span>
</a>
