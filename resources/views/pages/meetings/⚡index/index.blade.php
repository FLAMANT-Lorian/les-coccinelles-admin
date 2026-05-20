@php
    use App\Enums\MessageTypes;

    $segments = [
        [
            'label' => __('navigation/navigation.meetings')
        ],
    ];

    $heading = [
        'title' => __('pages/meetings.heading'),
        'subtitle' => __('pages/meetings.subtitle'),
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

        {{-- TABLE --}}
        <livewire:pages.meetings.table.table/>
    </div>

    {{-- MODAL --}}
    @if($this->openCreateModal)
        <x-widgets.modals.meetings.create-meeting/>
    @elseif($this->openEditModal)
        <x-widgets.modals.meetings.update-meeting/>
    @elseif($this->openDeleteModal)
        <x-widgets.modals.meetings.delete-meeting/>
    @elseif($this->deleteSelection)
        <x-widgets.modals.selection.delete-selection
            action="deleteMeetings"/>
    @endif
</div>
