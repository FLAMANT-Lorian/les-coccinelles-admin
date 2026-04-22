@php

    $segments = [
        [
            'label' => __('navigation/navigation.members'),
            'url' => route('members.index', ['locale' => app()->getLocale()])
        ],
        [
            'label' => __('pages/members.roles'),
            'url' => route('members.index', ['tab' => 'roles',])
        ],
        [
            'label' => $this->role->name,
        ],
        [
            'label' => __('pages/members.update-role'),
        ],
    ];

    $heading = [
        'title' => __('pages/members.update-role'),
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
        <livewire:pages.members.role.forms.update.form
            :role="$this->role"/>
    </div>
</div>
