@php
    use App\Enums\MessageTypes;

    $segments = [
        [
            'label' => __('navigation/navigation.bookings')
        ],
    ];

    $heading = [
        'title' => __('pages/hall.bookings.heading'),
        'subtitle' => __('pages/hall.bookings.subtitle'),
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
        <livewire:pages.bookings.table.table/>
    </div>

    {{-- MODALS --}}
    @if($this->openDeleteModal)
        <x-widgets.modals.bookings.delete-booking
            :id="$this->bookingToDelete"/>
    @elseif($this->openDeleteSelection)
        <x-widgets.modals.selection.delete-selection
            action="deleteBookings"/>
    @endif
</div>
