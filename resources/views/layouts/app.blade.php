<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body x-data="{ modalOpen: false }"
      class="bg-white lg:flex lg:flex-row"
      x-on:open-modal.window="modalOpen = true"
      x-on:close-modal.window="modalOpen = false"
      :class="modalOpen ? 'overflow-hidden' : ''">
    <x-icons.sprite/>

    <x-tools.breakpoints/>

    <header
        class="lg:sticky lg:top-0 relative lg:min-w-80 lg:w-80 lg:h-svh lg:border-r lg:border-r-beige-dark/60 lg:rounded-sm lg:overflow-hidden">
        <a href="#content"
           class="px-4 py-2 rounded-sm bg-brown text-white -left-full fixed z-10 top-4 focus:left-4 trans-all">
            {{ __('general.go_to_content') }}
        </a>
        {{-- NAVIGATION --}}
        <x-navigation.side-bar/>
    </header>
    <main id="content" class="grow w-full">
        {{ $slot }}
    </main>

    {{-- FLASH MESSAGE--}}
    <x-general.flash-message/>
</body>
</html>
