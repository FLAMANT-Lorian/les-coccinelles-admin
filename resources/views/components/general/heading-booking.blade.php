@php
    use App\Models\Booking;
        /**
        * @var Booking $booking
        */
@endphp

@props([
    'heading' => [],
    'booking',
])

<div class="flex flex-row justify-between items-center pb-8 lg:pb-6">
    <div class="flex flex-col gap-1">
        <h1 class="text-brown text-3xl rg:text-4.5xl font-semibold">
            {{ $heading['title'] }}
        </h1>
        <p class="paragraph text-gray-500">{!! $heading['subtitle'] !!}</p>
    </div>
    <div class="flex flex-row gap-6 items-center">
        <a class="text-white py-3 px-4 text-base font-normal rounded-sm border border-brown hover:text-brown hover:bg-transparent bg-brown trans-all"
           aria-label="{{ __('pages/hall.bookings-update.generate-contract') }}"
           title="{{ __('pages/hall.bookings-update.generate-contract') }}"
           href="{{ route('pdf.generate', ['bookingId' => $booking->id]) }}">
            {{ __('pages/hall.bookings-update.generate-contract') }}
        </a>
        {{--<a class="text-white py-3 px-4 text-base font-normal rounded-sm border border-brown hover:text-brown hover:bg-transparent bg-brown trans-all"
           aria-label="{{ __('pages/hall.bookings-update.generate-invoice') }}"
           title="{{ __('pages/hall.bookings-update.generate-invoice') }}"
           href="{{ route('pdf.generate') }}">
            {{ __('pages/hall.bookings-update.generate-invoice') }}
        </a>--}}
    </div>
</div>
