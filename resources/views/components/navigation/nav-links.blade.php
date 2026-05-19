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
            'route' => 'bookings.edit',
            'permission' => 'bookings.edit'
        ],
    ];

    $membersRoutes = [
        'members' => [
            'route' => 'members.index',
            'permission' => 'members.index'
        ],
        'members-create' => [
            'route' => 'members.create',
            'permission' => 'members.create'
        ],
         'members-edit' => [
            'route' => 'members.edit',
            'permission' => 'members.edit'
        ],
        'roles' => [
            'route' => 'roles.index',
            'permission' => 'roles.index'
        ],
        'roles-create' => [
            'route' => 'roles.create',
            'permission' => 'roles.create'
        ],
         'roles-edit' => [
            'route' => 'roles.edit',
            'permission' => 'roles.edit'
        ],
    ];

    $links = [
        [
            'label' => __('navigation/navigation.dashboard'),
            'route' => LaravelLocalization::localizeURL(route('dashboard')),
            'icon' => 'dashboard',
            'wire-current-exact' => true,
            'wire-current' => true,
            'permissions' => null
        ],
         [
            'label' => __('navigation/navigation.calendar'),
            'route' => LaravelLocalization::localizeURL(route('calendar')),
            'icon' => 'calendar',
            'wire-current' => true,
            'permissions' => 'calendar.index'
        ],
        [
            'label' => __('navigation/navigation.hall'),
            'route' => LaravelLocalization::localizeURL(getCorrectRoute($hallRoutes)),
            'icon' => 'hall',
            'active' => request()->routeIs(array_column($hallRoutes, 'route')),
            'permissions' => ['availabilities.index', 'hallRates.index', 'bookings.index', 'utilityCosts.index', 'interventions.index', 'contacts.index']
        ],
        [
            'label' => __('navigation/navigation.members'),
            'route' => LaravelLocalization::localizeURL(getCorrectRoute($membersRoutes)),
            'icon' => 'members',
            'active' => request()->routeIs(array_column($membersRoutes, 'route')),
            'permissions' => ['members.index', 'roles.index']
        ],
        [
            'label' => __('navigation/navigation.messages'),
            'route' => LaravelLocalization::localizeURL(route('messages')),
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
