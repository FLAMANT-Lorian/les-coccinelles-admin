@php

    $hallRoutes = [
        'availabilities' => [
            'route' => 'availabilities',
            'permission' => 'availabilities.index'
        ],
        'hallRates' => [
            'route' => 'hall-rates',
            'permission' => 'hallRates.index'
        ],
        'utilityCosts' => [
            'route' => 'utility-costs',
            'permission' => 'utilityCosts.index'
        ],
        'interventions' => [
            'route' => 'interventions',
            'permission' => 'interventions.index'
        ],
        'contacts' => [
            'route' => 'contacts',
            'permission' => 'contacts.index'
        ],
        'bookings' => [
            'route' => 'bookings.index',
            'permission' => 'bookings.index'
        ],
        'bookings-create' => [
            'route' => 'bookings.create',
            'permission' => 'bookings.create'
        ],
        'bookings-update' => [
            'route' => 'bookings.update',
            'permission' => 'bookings.edit'
        ],
    ];

    $membersRoutes = [
        'members' => [
            'route' => 'members.index',
            'permission' => 'members.index'
        ],
        'hallRates' => [
            'route' => 'roles.index',
            'permission' => 'roles.index'
        ],
    ];

    $links = [
        [
            'label' => __('navigation/navigation.dashboard'),
            'route' => route('dashboard'),
            'icon' => 'dashboard',
            'wire-current-exact' => true,
            'wire-current' => true,
            'permissions' => null
        ],
        [
            'label' => __('navigation/navigation.hall'),
            'route' => getCorrectRoute($hallRoutes),
            'icon' => 'hall',
            'active' => request()->routeIs(array_column($hallRoutes, 'route')),
            'permissions' => ['availabilities.index', 'hallRates.index', 'bookings.index', 'utilityCosts.index', 'interventions.index', 'contacts.index']
        ],
        [
            'label' => __('navigation/navigation.members'),
            'route' => getCorrectRoute($membersRoutes),
            'icon' => 'members',
            'wire-current' => true,
            'permissions' => ['members.index', 'roles.index']
        ],
        [
            'label' => __('navigation/navigation.messages'),
            'route' => route('messages'),
            'icon' => 'messages',
            'wire-current' => true,
            'permissions' => ['messages.index']
        ],
    ];

@endphp

<ul class="flex flex-col gap-4">
    @foreach ($links as $link)
        @if(!isset($link['permissions']) || auth()->user()->canAny($link['permissions']))
            <li>
                <x-navigation.nav-link
                    :label="$link['label']"
                    :route="$link['route']"
                    :icon="$link['icon']"
                    :wire_current_exact="$link['wire-current-exact'] ?? false"
                    :wire_current="$link['wire-current'] ?? false"
                    :active="$link['active'] ?? false"
                />
            </li>
        @endif
    @endforeach
</ul>
