@php

    $links = [
        [
            'label' => __('navigation/navigation.dashboard'),
            'route' => route('dashboard', ['locale' => app()->getLocale()]),
            'icon' => 'dashboard',
            'wire_current_exact' => true,
            'permission' => null
        ],
         [
            'label' => __('navigation/navigation.members'),
            'route' => route('members.index', ['locale' => app()->getLocale()]),
            'icon' => 'members',
            'permission' => null
        ],
        [
            'label' => __('navigation/navigation.messages'),
            'route' => route('messages', ['locale' => app()->getLocale()]),
            'icon' => 'messages',
            'permission' => 'messages.index'
        ],
    ];

@endphp

<ul class="flex flex-col gap-4">
    @foreach ($links as $link)
        @if(!isset($link['permission']) || auth()->user()->can($link['permission']))
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
