@php
    use App\Enums\MessageTypes;

    $segments = [
        [
            'label' => __('navigation/navigation.hall-rates')
        ],
    ];

    $heading = [
        'title' => __('pages/hall.hall-rates.heading'),
        'subtitle' => __('pages/hall.hall-rates.subtitle'),
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
        <livewire:pages.hall-rates.table.table/>
    </div>

    {{-- MODALS --}}
    @if($this->createHallRateModalOpen)
        <x-widgets.modals.hall-rates.create-hall-rate/>
    @elseif($this->updateHallRateModalOpen)
        <x-widgets.modals.hall-rates.update-hall-rate/>
    @elseif($this->deleteHallRateModalOpen)
        <x-widgets.modals.hall-rates.delete-hall-rates
            :id="$this->hallRate->id"/>
    @elseif($this->deleteHallRatesModalOpen)
        <x-widgets.modals.selection.delete-selection
            action="deleteHallRates"
        />
    @endif
</div>
