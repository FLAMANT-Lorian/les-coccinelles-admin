@php
    use App\Enums\MessageTypes;

    $segments = [
        [
            'label' => __('navigation/navigation.members'),
            'url' => route('members.index')
        ],
        [
            'label' => __('navigation/navigation.roles')
        ],
    ];

    $heading = [
        'title' => __('pages/roles.heading'),
        'subtitle' => __('pages/roles.subtitle'),
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
        <x-tabs.members-tabs/>

        {{-- TABLE --}}
        <livewire:pages.roles.table.table />
    </div>

    {{-- MODAL --}}
    @if($this->modalDeleteRole)
        <x-widgets.modals.roles.delete-role
            :id="$this->roleToDelete"/>
    @elseif($this->modalDeleteAllRoles)
        <x-widgets.modals.selection.delete-selection
            action="deleteAllRoles"/>
    @endif
</div>
