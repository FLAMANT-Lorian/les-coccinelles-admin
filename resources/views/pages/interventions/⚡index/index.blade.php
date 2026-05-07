@php
    use App\Enums\MessageTypes;

    $segments = [
        [
            'label' => __('navigation/navigation.interventions')
        ],
    ];

    $heading = [
        'title' => __('pages/hall.interventions.heading'),
        'subtitle' => __('pages/hall.interventions.subtitle'),
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
        <livewire:pages.interventions.table.table/>
    </div>

    {{-- MODALS --}}
    @if($this->openCreateModal)
        <x-widgets.modals.interventions.create-intervention/>
    @endif
</div>
