@php

    $links = [
        [
            'label' => __('navigation/navigation.dashboard'),
            'route' => route('dashboard', ['locale' => app()->getLocale()]),
            'icon' => 'dashboard'
        ]
    ];

@endphp

<ul>
    @foreach ($links as $link)
        <li>
            <x-navigation.nav-link
                :label="$link['label']"
                :route="$link['route']"
                :icon="$link['icon']"
            />
        </li>
    @endforeach
</ul>
