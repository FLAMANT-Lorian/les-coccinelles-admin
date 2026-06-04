@php
    use App\Enums\MessageTypes;

    $segments = [
        [
            'label' => __('navigation/navigation.calendar')
        ],
    ];

    $heading = [
        'title' => __('pages/calendar.heading'),
        'subtitle' => __('pages/calendar.subtitle'),
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

        {{-- CALENDRIER --}}
    </div>

    {{-- MODAL --}}
    <livewire:pages.calendar.calendar/>
</div>
