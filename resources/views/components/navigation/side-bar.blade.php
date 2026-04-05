<div class="menu lg:flex lg:flex-col lg:h-full lg:bg-beige-light">

    <div class="bg-white lg:mx-auto lg:bg-beige-light relative z-4 px-6 py-6 lg:pb-20 flex flex-row items-center justify-between gap-6 max-lg:border-b max-lg:border-b-beige-dark/60">
        <a wire:navigate
           class="w-40 h-12 lg:w-50 lg:h-15"
           title="{{ __('navigation/navigation.back_to_dashboard') }}"
           aria-label="{{ __('navigation/navigation.back_to_dashboard') }}"
           href="{{ route('dashboard', ['locale' => app()->getLocale()]) }}">
            <span class="sr-only">{{ __('navigation/navigation.back_to_dashboard') }}</span>
            <svg class="w-full h-full" width="160" height="48">
                <use href="#logo"></use>
            </svg>
        </a>
        <input type="checkbox" id="menu" class="sr-only lg:hidden menu-input">
        <label for="menu" class="menu-label relative z-3 lg:hidden!">
            <span class="sr-only">{{ __('navigation/navigation.open_menu_mobile') }}</span>
            <span class="line line-1"></span>
            <span class="line line-2"></span>
            <span class="line line-3"></span>
        </label>
    </div>

    {{-- NAVIGATION BAR --}}
    <x-navigation.nav-bar/>
</div>
