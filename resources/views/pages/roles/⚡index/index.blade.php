@php
    use App\Enums\MessageTypes;

    $segments = [
        [
            'label' => __('navigation/navigation.members'),
            'url' => route('members.index', ['locale' => app()->getLocale()])
        ],
        [
            'label' => __('navigation/navigation.roles')
        ],
    ];

    $heading = [
        'title' => __('pages/roles.heading'),
        'subtitle' => __('pages/roles.subtitle'),
    ];

    $tabs = [
        [
            'label' => __('pages/members.members'),
            'location' => route('members.index', ['locale' => app()->getLocale()])
        ],
        [
            'label' => __('pages/roles.role'),
            'location' => route('roles.index', ['locale' => app()->getLocale()])
        ]
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

        {{-- TAB --}}
        <x-general.tabs
            :tabs="$tabs"/>

        {{-- TABLE --}}
        <livewire:pages.roles.table.table />
    </div>

    {{-- MODAL --}}
    @if($this->modalDeleteRole)
        <x-widgets.modals.delete-role
            :id="$this->roleToDelete"/>
    @elseif($this->modalDeleteAllRoles)
        <x-widgets.modals.delete-selection
            action="deleteAllRoles"/>
    @endif
</div>
