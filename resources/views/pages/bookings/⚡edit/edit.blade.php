@php
    use App\Models\Booking;

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
        <x-general.heading-booking
            :heading="$heading"
            :booking="$this->booking"/>

        {{-- FORM --}}
        <livewire:pages.bookings.forms.update.form
            :booking="$this->booking"/>

        {{-- DANGER ZONE --}}
        @can('delete', Booking::class)
            <x-pages.bookings.forms.update.danger-zone
                :booking="$this->booking"/>
        @endcan
    </div>

    {{-- MODALS --}}
    @if($this->openDeleteModal)
        <x-widgets.modals.bookings.delete-booking
            :id="$this->booking->id"/>
    @endif
</div>
