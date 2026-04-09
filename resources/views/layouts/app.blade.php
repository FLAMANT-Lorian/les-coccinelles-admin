<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-white lg:flex lg:flex-row">
    <x-icons.sprite/>

    <x-tools.breakpoints/>

    <header
        class="relative lg:min-w-80 lg:w-80 lg:h-svh lg:border-r lg:border-r-beige-dark/60 lg:rounded-sm lg:overflow-hidden">
        {{-- NAVIGATION --}}
        <x-navigation.side-bar/>
    </header>
    <main id="content" class="grow w-full">
        {{ $slot }}
    </main>
</body>
</html>
