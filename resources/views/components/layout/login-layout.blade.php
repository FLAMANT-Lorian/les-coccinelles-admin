<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Flamant Lorian">
    <meta name="description" content="Intranet permettant la gestion de l’asbl des Coccinelles de Morhet">
    <meta name="keywords" content="ASBL, Intranet, Coccinelles, Morhet, Village">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title . ' · ' . config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <x-icons.sprite/>

    {!! $slot !!}
    @livewireScripts
</body>
</html>
