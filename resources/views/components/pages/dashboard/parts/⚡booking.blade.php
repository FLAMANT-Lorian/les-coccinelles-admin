<?php

use App\Models\Booking;
use App\Models\Meeting;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use App\Models\Event;

new class extends Component {

    public Booking $booking;

    public function mount(): void
    {
        $this->booking = Booking::whereHas('bookingDate', function (Builder $q) {
            $q->orderBy('start_date');
        })->first();
    }
};
?>

<section
    class="flex flex-col col-span-full rl:col-span-2 lg:col-span-5 p-4 rounded-sm border border-beige-dark/60 bg-beige-light">
    <div class="flex flex-row items-center justify-between pb-4 border-b border-b-beige-dark/60">
        <h2 class="text-xl font-medium">{{ __('pages/dashboard.booking.title') }}</h2>
        @can('view-any', Booking::class)
            <a aria-label="{{ __('pages/dashboard.booking.see_all') }}"
               href="{{ route('bookings.index') }}">
                <x-pages.dashboard.arrow/>
                <span class="sr-only">{{ __('pages/dashboard.booking.see_all') }}</span>
            </a>
        @endcan
    </div>
    <div class="flex flex-col items-start gap-4 grow">
        <div class="flex flex-row gap-4 items-center mt-4">
            <time datetime="{{ $booking->bookingDate->start_date->format('Y-m-d') }}">
                {{ formattedDate($booking->bookingDate->start_date) }}
            </time>
            <svg width="17" height="8" viewBox="0 0 17 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M16.3536 4.03553C16.5488 3.84027 16.5488 3.52368 16.3536 3.32842L13.1716 0.146437C12.9763 -0.0488231 12.6597 -0.0488232 12.4645 0.146437C12.2692 0.341697 12.2692 0.658287 12.4645 0.853547L15.2929 3.68197L12.4645 6.5104C12.2692 6.70566 12.2692 7.02224 12.4645 7.21751C12.6597 7.41277 12.9763 7.41277 13.1716 7.21751L16.3536 4.03553ZM3.21889e-07 3.68197L2.78178e-07 4.18197L16 4.18197L16 3.68197L16 3.18197L3.65601e-07 3.18197L3.21889e-07 3.68197Z"
                    fill="#3D2B1F"/>
            </svg>
            <time datetime="{{ $booking->bookingDate->end_date->format('Y-m-d') }}">
                {{ formattedDate($booking->bookingDate->end_date) }}
            </time>
        </div>
        <div class="flex flex-row items-center gap-2 text-base text-brown">
            <span class="pr-2 border-r border-r-beige-dark/60 font-semibold">{{ $booking->contact->full_name }}</span>
            <span>{{ $booking->contact->email }}</span>
        </div>
        <div class="flex flex-row gap-2 text-red">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12.586 2.586C12.211 2.2109 11.7024 2.00011 11.172 2H4C3.46957 2 2.96086 2.21071 2.58579 2.58579C2.21071 2.96086 2 3.46957 2 4V11.172C2.00011 11.7024 2.2109 12.211 2.586 12.586L11.29 21.29C11.7445 21.7416 12.3592 21.9951 13 21.9951C13.6408 21.9951 14.2555 21.7416 14.71 21.29L21.29 14.71C21.7416 14.2555 21.9951 13.6408 21.9951 13C21.9951 12.3592 21.7416 11.7445 21.29 11.29L12.586 2.586Z"
                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                <path
                    d="M7.5 8C7.77614 8 8 7.77614 8 7.5C8 7.22386 7.77614 7 7.5 7C7.22386 7 7 7.22386 7 7.5C7 7.77614 7.22386 8 7.5 8Z"
                    fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="">{{ $booking->hall_rate->type }}</span>
        </div>
        @can('update', Booking::class)
            <a class="mt-auto btn-small bg-brown text-white hover:bg-transparent hover:text-brown border border-brown"
               aria-label="{{ __('pages/dashboard.booking.see_booking') }}"
               href="{{ route('bookings.edit', ['booking' => $booking->id]) }}">
                {{ __('pages/dashboard.booking.see_booking') }}
            </a>
        @endcan
    </div>
</section>
