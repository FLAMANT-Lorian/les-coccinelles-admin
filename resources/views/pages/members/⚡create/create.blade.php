@php

    $segments = [
        [
            'label' => __('navigation/navigation.members'),
            'url' => route('members.index', ['locale' => app()->getLocale()])
        ],
        [
            'label' => __('pages/members.add-members'),
        ],
    ];

    $heading = [
    'title' => __('pages/members.add-members'),
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
        <livewire:pages.members.members.forms.create.form/>
    </div>
</div>
