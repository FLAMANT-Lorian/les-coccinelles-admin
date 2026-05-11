@php
    use App\Enums\MessageTypes;

    $segments = [
        [
            'label' => __('navigation/navigation.bookings'),
            'url' => route('bookings.index'),
        ],
        [
            'label' => __('navigation/navigation.create')
        ],
    ];

    $heading = [
        'title' => __('pages/hall.bookings-create.heading'),
        'subtitle' => __('pages/hall.bookings-create.subtitle'),
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

        {{-- FORM --}}
        <livewire:pages.bookings.forms.create.form/>
    </div>
</div>
