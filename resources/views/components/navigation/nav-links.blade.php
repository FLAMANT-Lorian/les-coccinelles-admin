@php

    $links = [
        [
            'label' => __('navigation/navigation.dashboard'),
            'route' => route('dashboard', ['locale' => app()->getLocale()]),
            'icon' => 'dashboard',
            'wire_current_exact' => true,
            'permissions' => null
        ],
        [
            'label' => __('navigation/navigation.hall'),
            'route' => route('availabilities.index', ['locale' => app()->getLocale()]),
            'icon' => 'hall',
            'wire_current_exact' => true,
            'permissions' => null
        ],
        [
            'label' => __('navigation/navigation.members'),
            'route' => route('members.index', ['locale' => app()->getLocale()]),
            'icon' => 'members',
            'permissions' => ['members.index', 'roles.index']
        ],
        [
            'label' => __('navigation/navigation.messages'),
            'route' => route('messages', ['locale' => app()->getLocale()]),
            'icon' => 'messages',
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
                    :wire_current_exact="$link['wire_current_exact'] ?? false"
                />
            </li>
        @endif
    @endforeach
</ul>
