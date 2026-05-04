@php
    use App\Enums\MessageTypes;

    $segments = [
        [
            'label' => __('navigation/navigation.availabilities')
        ],
    ];

    $heading = [
        'title' => __('pages/hall.availabilities.heading'),
        'subtitle' => __('pages/hall.availabilities.subtitle'),
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

        {{-- TABS --}}
        <x-tabs.hall-tabs/>

        {{-- TABLE --}}
        <livewire:pages.availabilities.tables.contact.table/>
    </div>

    {{-- MODALS --}}
    @if($this->modalDeleteAll)
        <x-widgets.modals.selection.delete-selection
            action="deleteAvailabilityRequests"/>
    @elseif($this->modalViewAvailabilityRequest)
        <x-widgets.modals.availability-requests.view-availability-request
            :availability-request="$this->availabilityRequestToSee"/>
    @elseif($this->modalDeleteAvailabilityRequest)
        <x-widgets.modals.availability-requests.delete-availability-request
            :id="$this->availabilityRequestToDelete"/>
    @endif
</div>
