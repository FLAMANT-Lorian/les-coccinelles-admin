@php

    $links = [
        [
            'label' => __('navigation/navigation.dashboard'),
            'route' => route('dashboard', ['locale' => app()->getLocale()]),
            'icon' => 'dashboard'
        ]
    ];

@endphp

<div class="nav-container px-6 py-12 lg:pt-0 lg:pb-6 h-full"
     role="navigation"
     aria-label="{{ __('navigation/navigation.main-navigation') }}">

    <x-navigation.nav-links/>

    <x-navigation.bottom-links/>
</div>
