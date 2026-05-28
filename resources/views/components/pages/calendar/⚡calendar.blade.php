<?php

use App\Models\Booking;
use App\Models\Intervention;
use App\Models\Meeting;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {

    #[Computed]
    public function getEvents(): array
    {
        $events = [];

        $bookings = Booking::with(['contact', 'bookingDate'])->get();
        $interventions = Intervention::get();
        $meetings = Meeting::get();

        foreach ($bookings as $booking) {
            $is_one_day = Carbon::parse($booking->bookingDate->start_date)->format('Y-m-d') === Carbon::parse($booking->bookingDate->end_date)->format('Y-m-d');
            $event = [
                'title' => 'Réservation salle – ' . $booking->contact->full_name,
                'start' => Carbon::parse($booking->bookingDate->start_date)->startOfDay()->format($is_one_day ? 'Y-m-d' : 'Y-m-d\TH:i:s'),
                'end' => Carbon::parse($booking->bookingDate->end_date)->endOfDay()->format($is_one_day ? 'Y-m-d' : 'Y-m-d\TH:i:s'),
                'backgroundColor' => '#DBEAFE',
                'textColor' => '#3B82F6',
            ];

            if (auth()->user()->can('update', Booking::class)) {
                $event['url'] = route('bookings.edit', ['booking' => $booking->id]);
            }

            $events[] = $event;
        }

        foreach ($interventions as $intervention) {
            $event = [
                'title' => $intervention->name,
                'start' => Carbon::parse($intervention->deadline)->format('Y-m-d'),
                'backgroundColor' => '#F8D2C9',
                'textColor' => '#C6390E',
            ];

            if (auth()->user()->can('view-any', Intervention::class)) {
                $event['url'] = route('interventions', ['term' => $intervention->name]);
            }

            $events[] = $event;
        }

        foreach ($meetings as $meeting) {
            $event = [
                'title' => __('pages/meetings.meeting') . ' #' . $meeting->id . ' – ' . Carbon::parse($meeting->hour)->format('H:i'),
                'start' => Carbon::parse($meeting->date)->format('Y-m-d'),
                'backgroundColor' => '#E3F0E7',
                'textColor' => '#57A770',
            ];

            if (auth()->user()->can('view-any', Meeting::class)) {
                $event['url'] = route('meetings', ['term' => $meeting->id]);
            }

            $events[] = $event;
        }

        return $events;
    }
};
?>

@php
    $legend = [
         [
            'text' => __('navigation/navigation.bookings'),
            'color' => '#3B82F6',
        ],
        [
            'text' => __('navigation/navigation.interventions'),
            'color' => '#C6390E',
        ],
        [
            'text' => __('navigation/navigation.meetings'),
            'color' => '#57A770',
        ],
        [
            'text' => __('navigation/navigation.events'),
            'color' => '#6554B6',
        ],
    ];
@endphp


<div wire:ignore>
    <div id="coccinelles-calendar" data-events="{{ json_encode($this->getEvents()) }}"></div>
    <div class="flex flex-row flex-wrap gap-8 mt-8 lg:mt-12 justify-center">
        @foreach($legend as $item)
            <div class="flex flex-row gap-2.5 justify-center">
                <div class="h-6 w-12 rounded-sm"
                     style="background-color: {{ $item['color'] }}"></div>
                <span class="paragraph text-brown">{{$item['text']}}</span>
            </div>
        @endforeach
    </div>
</div>
