@php

    $segments = [
        [
            'label' => __('navigation/navigation.members'),
            'url' => route('members.index')
        ],
        [
            'label' => __('pages/roles.roles'),
            'url' => route('roles.index')
        ],
        [
            'label' => __('pages/roles.add-role'),
        ],
    ];

    $heading = [
        'title' => __('pages/roles.add-role'),
        'subtitle' => __('forms.accessibility_text'),
    ];
@endphp

<div class="wrapper" x-data="{ modalOpen: false }">
    {{-- BREADCRUMB --}}
    <x-general.breadcrumb
        :segments="$segments"/>

    <div class="content">
        {{-- HEADING --}}
        <x-general.heading
            :heading="$heading"/>

        {{-- FORM --}}
        <livewire:pages.roles.forms.create.form/>
    </div>
</div>
