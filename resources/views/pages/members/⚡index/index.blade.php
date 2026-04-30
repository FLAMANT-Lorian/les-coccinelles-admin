@php
    use App\Enums\MessageTypes;

    $segments = [
        [
            'label' => __('navigation/navigation.members')
        ],
    ];

    $heading = [
        'title' => __('pages/members.heading'),
        'subtitle' => __('pages/members.subtitle'),
    ];

    $tabs = [
        [
            'label' => __('pages/members.members'),
            'location' => route('members.index', ['locale' => app()->getLocale()]),
            'permission' => 'members.index'
        ],
        [
            'label' => __('pages/roles.role'),
            'location' => route('roles.index', ['locale' => app()->getLocale()]),
            'permission' => 'roles.index'
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
        <livewire:pages.members.table.table/>
    </div>

    {{-- MODAL --}}
    @if($this->modalDeleteAll)
        <x-widgets.modals.delete-selection
            action="deleteMembers"/>
    @elseif($this->modalDeleteMember)
        <x-widgets.modals.delete-member
            :id="$this->memberToDelete"/>
    @endif
</div>
