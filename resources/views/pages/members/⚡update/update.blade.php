@php

    $segments = [
        [
            'label' => __('navigation/navigation.members'),
            'url' => route('members.index', ['locale' => app()->getLocale()])
        ],
        [
            'label' => $this->member->full_name,
        ],
        [
            'label' => __('pages/members.update-members'),
        ],
    ];

    $heading = [
    'title' => __('pages/members.profile-of') . ' ' . $this->member->full_name,
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
        <livewire:pages.members.members.forms.update.form
            :member="$member"/>
    </div>
</div>
