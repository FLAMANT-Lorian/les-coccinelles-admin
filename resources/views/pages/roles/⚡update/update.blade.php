@php

    $segments = [
        [
            'label' => __('navigation/navigation.members'),
            'url' => route('members.index', ['locale' => app()->getLocale()])
        ],
        [
            'label' => __('pages/roles.roles'),
            'url' => route('roles.index', ['locale' => app()->getLocale()])
        ],
        [
            'label' => $this->role->name,
        ],
        [
            'label' => __('pages/roles.update-role'),
        ],
    ];

    $heading = [
        'title' => __('pages/roles.update-role'),
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
        <livewire:pages.roles.forms.update.form
            :role="$this->role"/>

        {{-- DANGER ZONE --}}
        @can('roles.delete')
            <x-pages.roles.forms.update.danger-zone
                :role="$this->role"/>
        @endcan
    </div>

    {{-- MODAL --}}
    @if($this->modalDeleteRole)
        <x-widgets.modals.delete-role
            :id="$this->roleToDelete"/>
    @endif
</div>
