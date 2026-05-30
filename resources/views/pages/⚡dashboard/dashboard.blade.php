@php
    $segments = [
        [
            'label' => __('navigation/navigation.dashboard')
        ],
    ]
@endphp

<div class="wrapper">
    {{-- BREADCRUMB --}}
    <x-general.breadcrumb
        :segments="$segments"/>

    <div class="grid-default gap-8">
        {{-- HEADING --}}
        <x-pages.dashboard.parts.heading/>

        {{-- LAST EVENT --}}
        <livewire:pages.dashboard.parts.event/>

        {{-- LAST BOOKING --}}
        <livewire:pages.dashboard.parts.booking/>

        {{-- INTERVENTIONS --}}
        <livewire:pages.dashboard.parts.interventions/>
    </div>
</div>
