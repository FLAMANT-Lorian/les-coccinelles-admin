@php
    use Carbon\Carbon;

    $current_date = Carbon::now()->translatedFormat('l d F Y');
@endphp

@props([
    'segments' => [],
])

<div class="flex flex-row items-center justify-between lg:pb-4 lg:border-b lg:border-b-beige-dark/60">
    <div class="flex flex-row items-center gap-3 paragraph">
        <a wire:navigate
           aria-label="{{ __('navigation/navigation.got_to_title') . __('navigation/navigation.dashboard') }}"
           title="{{ __('navigation/navigation.got_to_title') . __('navigation/navigation.dashboard') }}"
           href="{{ route('dashboard', ['locale' => app()->getLocale()]) }}">
            <span
                class="sr-only">{{ __('navigation/navigation.got_to_title') . __('navigation/navigation.dashboard') }} </span>
            <svg class="text-red hover:text-brown trans-all" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <use href="#home"></use>
            </svg>
        </a>
        @if(!empty($segments))
            @foreach ($segments as $segment)
                @if($loop->first)
                    <svg class="text-brown min-w-1.25 min-h-2 w-1.5 h-2" width="5" height="8" viewBox="0 0 5 8"
                         fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <use href="#breadcrumb-separator"></use>
                    </svg>
                @endif
                @if($loop->last)
                    <span class="text-brown">
                    {{ $segment['label'] }}
                </span>
                @else
                    <a aria-label="{{ $segment['label'] }}"
                       title="{{ __('navigation/navigation.got_to_title') . $segment['label'] }}"
                       href="{{ $segment['url'] }}"
                       wire:navigate
                       class="text-red font-semibold hover:text-brown trans-all">
                        {{ $segment['label'] }}
                    </a>
                    <svg class="min-w-1.25 min-h-2 w-1.5 h-2" width="5" height="8" viewBox="0 0 5 8" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <use href="#breadcrumb-separator"></use>
                    </svg>
                @endif
            @endforeach
        @endif
    </div>
    <div class="max-lg:hidden flex flex-row items-center gap-4 text-brown">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <use href="#calendar"></use>
        </svg>
        <time class="first-letter:uppercase" datatype="{{ $current_date }}">{{ $current_date }}</time>
    </div>
</div>
