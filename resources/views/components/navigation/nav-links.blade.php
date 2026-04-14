@php

    $links = [
        [
            'label' => __('navigation/navigation.dashboard'),
            'route' => route('dashboard', ['locale' => app()->getLocale()]),
            'icon' => 'dashboard',
            'wire_current_exact' => true
        ],
         [
            'label' => __('navigation/navigation.members'),
            'route' => route('members', ['locale' => app()->getLocale()]),
            'icon' => 'members',
        ],
        [
            'label' => __('navigation/navigation.messages'),
            'route' => route('messages', ['locale' => app()->getLocale()]),
            'icon' => 'messages',
        ],
    ];

@endphp

<ul class="flex flex-col gap-4">
    @foreach ($links as $link)
        <li>
            <x-navigation.nav-link
                :label="$link['label']"
                :route="$link['route']"
                :icon="$link['icon']"
                :wire_current_exact="$link['wire_current_exact'] ?? false"
            />
        </li>
    @endforeach
</ul>
