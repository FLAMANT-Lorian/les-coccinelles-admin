<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Flamant Lorian">
    <meta name="description" content="Site d’administration pour l’asbl Les Coccinelles situé à Morhet">
    <meta name="keywords" content="ASBL, Morhet, Village, Site, Administration">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title . ' · ' . config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <x-icons.sprite/>

    {!! $slot !!}
    @livewireScripts

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif
</body>
</html>
