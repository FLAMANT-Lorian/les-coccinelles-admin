<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Flamant Lorian">
    <meta name="description" content="Site d’administration pour l’asbl Les Coccinelles situé à Morhet">
    <meta name="keywords" content="ASBL, Morhet, Village, Site, Administration">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('page-title.login') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-tools.breakpoints/>
    {!! $slot !!}
</body>
</html>
