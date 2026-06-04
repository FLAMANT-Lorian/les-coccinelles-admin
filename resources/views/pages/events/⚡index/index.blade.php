@php
    use App\Enums\MessageTypes;

    $segments = [
        [
            'label' => __('navigation/navigation.events')
        ],
    ];

    $heading = [
        'title' => __('pages/events.heading'),
        'subtitle' => __('pages/events.subtitle'),
    ];
@endphp

<div class="wrapper">
    {{-- BREADCRUMB --}}
    <x-general.breadcrumb
        :segments="$segments"/>

    <div class="content">
        {{-- HEADING --}}
        <x-general.heading
            :heading="$heading"/>

        {{-- TABLE --}}
        <livewire:pages.events.table.table/>
    </div>

    {{-- MODALS --}}
    @if($this->openCreateModal)
        <x-widgets.modals.events.create-event/>
    @elseif($this->openUpdateModal)
        <x-widgets.modals.events.update-event/>
    @elseif($this->openDeleteModal)
        <x-widgets.modals.events.delete-event
            :id="$event->id"/>
    @elseif($this->openDeleteSelectionModal)
        <x-widgets.modals.selection.delete-selection
            action="deleteEvents"/>
    @endif
</div>
