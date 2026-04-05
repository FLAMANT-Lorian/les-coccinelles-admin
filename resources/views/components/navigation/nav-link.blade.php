@props([
    'label',
    'route',
    'icon'
])
<a wire:navigate
   wire:current="bg-red text-white"
   {{ $attributes->merge(['class' => 'btn text-brown hover:bg-red hover:text-white focus:bg-red focus:text-white']) }}
   aria-label="{{ $label }}"
   title="{{ __('navigation/navigation.got_to_title') . $label }}"
   href="{{ $route }}">
    @switch($icon)
        @case('dashboard')
            <svg class="min-w-6 min-h-6" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <use href="#{{ $icon }}"></use>
            </svg>
            @break
        @case('help')
            <svg class="min-w-6 min-h-6" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <use href="#{{ $icon }}"></use>
            </svg>
            @break
    @endswitch
    <span>{{ $label }}</span>
</a>
