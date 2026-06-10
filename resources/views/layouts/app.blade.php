<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Flamant Lorian">
    <meta name="description" content="Intranet permettant la gestion de l’asbl des Coccinelles de Morhet">
    <meta name="keywords" content="ASBL, Intranet, Coccinelles, Morhet, Village">

    <title>{{ __($title) . ' · ' . config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- FAVICON --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('assets/img/favicon/site.webmanifest') }}">

</head>
<body x-data="{ modalOpen: false }"
      class="bg-white lg:flex lg:flex-row"
      x-on:open-modal.window="modalOpen = true"
      x-on:close-modal.window="modalOpen = false"
      :class="modalOpen ? 'overflow-hidden' : ''">
    <x-icons.sprite/>

    @if(app()->environment('local'))
        <x-tools.breakpoints/>
    @endif


    <header
        class="lg:sticky lg:top-0 relative lg:min-w-80 lg:w-80 lg:h-svh lg:border-r lg:border-r-beige-dark/60 lg:rounded-sm lg:overflow-hidden">
        <a href="#content"
           class="px-4 py-2 rounded-sm bg-brown text-white -left-full fixed z-40 top-4 focus:left-4 trans-all">
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
