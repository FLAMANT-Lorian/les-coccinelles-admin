@php
    use App\Enums\MessageTypes;

    $segments = [
        [
            'label' => __('navigation/navigation.bookings'),
            'url' => route('bookings.index'),
        ],
        [
          'label' => $this->booking->uniqid,
        ],
        [
            'label' => __('navigation/navigation.update')
        ],
    ];

    $heading = [
        'title' => __('pages/hall.bookings-update.heading') . $booking->contact->full_name,
        'subtitle' => __('pages/hall.bookings-update.subtitle'),
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
        <livewire:pages.bookings.forms.update.form
            :booking="$this->booking"/>
    </div>
</div>
