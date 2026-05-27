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

</div>
