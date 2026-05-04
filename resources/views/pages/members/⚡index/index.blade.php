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
        <livewire:pages.members.table.table/>
    </div>

    {{-- MODAL --}}
    @if($this->modalDeleteAll)
        <x-widgets.modals.selection.delete-selection
            action="deleteMembers"/>
    @elseif($this->modalDeleteMember)
        <x-widgets.modals.members.delete-member
            :id="$this->memberToDelete"/>
    @endif
</div>
