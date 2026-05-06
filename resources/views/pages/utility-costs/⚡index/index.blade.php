@php
    use App\Enums\MessageTypes;

    $segments = [
        [
            'label' => __('navigation/navigation.utility-costs')
        ],
    ];

    $heading = [
        'title' => __('pages/hall.utility-costs.heading'),
        'subtitle' => __('pages/hall.utility-costs.subtitle'),
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
        <livewire:pages.utility-costs.table.table/>
    </div>

    {{-- MODALS --}}
    @if($this->createUtilityCostModalOpen)
        <x-widgets.modals.utility-costs.create-utility-cost/>
    @endif

</div>
