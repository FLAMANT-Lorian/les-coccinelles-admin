<div class="mt-auto flex flex-col">

    <x-navigation.nav-link
        :label="__('navigation/navigation.help')"
        route="/help"
        icon="help"
        class="mb-6"
    />

    {{-- SETTINGS --}}
    <a href="#"
       title="{{ __('navigation/navigation.settings') }}"
       aria-label="{{ __('navigation/navigation.settings') }}"
       class="relative after:content-[''] after:absolute after:left-0 after:right-0 after:h-px after:bg-beige-dark/60 after:-top-4 mt-4 text-brown rounded-sm flex flex-row items-center gap-4 py-3 hover:px-4 trans-all hover:bg-beige-medium">
        <span class="sr-only">{{ __('navigation/navigation.settings') }}</span>
        <div class="h-12 w-12 bg-gray rounded-full"></div>
        <div class="flex flex-col items-start gap-0.5">
            <p class="font-medium text-brown">John Doe</p>
            <p class="text-sm text-gray-500">Admin</p>
        </div>
        <svg class="text-brown min-h-6 ml-auto" width="24" height="24" viewBox="0 0 24 24" fill="none"
             xmlns="http://www.w3.org/2000/svg">
            <use href="#settings"></use>
        </svg>
    </a>

    {{-- LOGOUT --}}
    <form action="{{ route('logout') }}" method="POST" class="mt-4 w-full">
        @csrf
        <button type="submit"
                class="w-full btn justify-center bg-brown outline outline-brown text-white hover:text-brown hover:bg-transparent focus:text-brown focus:bg-transparent">
            <svg class="min-w-6 min-h-6" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <use href="#logout"></use>
            </svg>
            <span>{{ __('navigation/navigation.logout') }}</span>
        </button>
    </form>
    <p class="mt-4 text-center text-brown">© 2026 – Les coccinelles ASBL</p>
</div>
