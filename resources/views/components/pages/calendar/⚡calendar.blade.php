<?php

use App\Models\Booking;
use App\Models\Intervention;
use App\Models\Meeting;
use App\Models\Event;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {

    public function getEvents(): array
    {
        $events = [];

        // BOOKINGS
        $bookings = Booking::with(['contact', 'bookingDate'])->get();
        foreach ($bookings as $booking) {
            $is_one_day = Carbon::parse($booking->bookingDate->start_date)->format('Y-m-d') === Carbon::parse($booking->bookingDate->end_date)->format('Y-m-d');
            $event = [
                'type' => 'bookings',
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

        // INTERVENTIONS
        $interventions = Intervention::get();
        foreach ($interventions as $intervention) {
            $event = [
                'type' => 'interventions',
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

        // MEETINGS
        $meetings = Meeting::get();
        foreach ($meetings as $meeting) {
            $event = [
                'type' => 'meetings',
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

        // EVENTS
        $events_db = Event::get();
        foreach ($events_db as $event_db) {
            $is_one_day = Carbon::parse($event_db->start_date)->format('Y-m-d') === Carbon::parse($event_db->end_date)->format('Y-m-d');
            $event = ['type' => 'events',
                'title' => $event_db->name,
                'start' => Carbon::parse($event_db->start_date)->startOfDay()->format($is_one_day ? 'Y-m-d' : 'Y-m-d\TH:i:s'),
                'end' => Carbon::parse($event_db->end_date)->endOfDay()->format($is_one_day ? 'Y-m-d' : 'Y-m-d\TH:i:s'),
                'backgroundColor' => '#E4DCF4',
                'textColor' => '#6554B6',];

            if (auth()->user()->can('view-any', Meeting::class)) {
                $event['url'] = route('events.show', ['event' => $event_db->id]);
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
            'type' => 'bookings',
        ],
        [
            'text' => __('navigation/navigation.interventions'),
            'color' => '#C6390E',
            'type' => 'interventions',

        ],
        [
            'text' => __('navigation/navigation.meetings'),
            'color' => '#57A770',
            'type' => 'meetings',
        ],
        [
            'text' => __('navigation/navigation.events'),
            'color' => '#6554B6',
            'type' => 'events',
        ],
    ];
@endphp


<div>
    <div wire:ignore>
        <div id="coccinelles-calendar" data-events="{{ json_encode($this->getEvents()) }}"></div>
    </div>
    <div class="flex flex-row flex-wrap gap-8 mt-8 lg:mt-12 justify-center">
        @foreach($legend as $item)
            <button type="button"
                    data-type="{{ $item['type'] }}"
                    class="flex flex-row gap-2.5 justify-center trans-all">
                <div class="h-6 w-12 rounded-sm"
                     style="background-color: {{ $item['color'] }}"></div>
                <span class="paragraph text-brown">{{$item['text']}}</span>
            </button>
        @endforeach
    </div>
</div>
