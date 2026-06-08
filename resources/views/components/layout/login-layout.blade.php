<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Flamant Lorian">
    <meta name="description" content="Intranet permettant la gestion de l’asbl des Coccinelles de Morhet">
    <meta name="keywords" content="ASBL, Intranet, Coccinelles, Morhet, Village">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title . ' · ' . config('app.name') }}</title>

    {{-- FAVICON --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('assets/img/favicon/site.webmanifest') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <x-icons.sprite/>

    {!! $slot !!}
    @livewireScripts
</body>
</html>
