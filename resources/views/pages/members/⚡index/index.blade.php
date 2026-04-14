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
            'location' => 'members'
        ],
        [
            'label' => __('pages/members.role'),
            'location' => 'role'
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
        @if($this->tab === 'members')

        @else($this->tab === 'role')
            <livewire:pages.members.role.table/>
        @endif
    </div>

    {{-- MODAL --}}
    @if($this->modalDeleteAll)
        <x-widgets.modals.delete-selection/>
    @endif
</div>
