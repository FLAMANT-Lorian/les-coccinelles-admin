<?php

use App\Models\Booking;
use App\Models\Intervention;
use App\Models\Meeting;
use App\Models\Event;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {

    public bool $bookings_visibility = true;
    public bool $interventions_visibility = true;
    public bool $meetings_visibility = true;
    public bool $events_visibility = true;

    #[Computed]
    public function getEvents(): array
    {
        $events = [];

        if ($this->bookings_visibility) {
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
        }

        if ($this->interventions_visibility) {
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
        }

        if ($this->meetings_visibility) {
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
        }

        if ($this->events_visibility) {
            $events_db = Event::get();
            foreach ($events_db as $event_db) {
                $is_one_day = Carbon::parse($event_db->start_date)->format('Y-m-d') === Carbon::parse($event_db->end_date)->format('Y-m-d');
                $event = [
                    'type' => 'events',
                    'title' => $event_db->name,
                    'start' => Carbon::parse($event_db->start_date)->startOfDay()->format($is_one_day ? 'Y-m-d' : 'Y-m-d\TH:i:s'),
                    'end' => Carbon::parse($event_db->end_date)->endOfDay()->format($is_one_day ? 'Y-m-d' : 'Y-m-d\TH:i:s'),
                    'backgroundColor' => '#E4DCF4',
                    'textColor' => '#6554B6',
                ];

                if (auth()->user()->can('view-any', Meeting::class)) {
                    $event['url'] = route('events.show', ['event' => $event_db->id]);
                }

                $events[] = $event;
            }
        }

        return $events;
    }

    public function switchVisibility(string $id): void
    {
        if ($id === 'bookings') {
            $this->bookings_visibility = !$this->bookings_visibility;
        } elseif ($id === 'interventions') {
            $this->interventions_visibility = !$this->interventions_visibility;
        } elseif ($id === 'meetings') {
            $this->meetings_visibility = !$this->meetings_visibility;
        } elseif ($id === 'events') {
            $this->events_visibility = !$this->events_visibility;
        }

        $this->dispatch('update-calendar', events: $this->getEvents());
    }
};
?>

@php
    $legend = [
         [
            'text' => __('navigation/navigation.bookings'),
            'color' => '#3B82F6',
            'id' => 'bookings',
            'state' => $this->bookings_visibility
        ],
        [
            'text' => __('navigation/navigation.interventions'),
            'color' => '#C6390E',
            'id' => 'interventions',
            'state' => $this->interventions_visibility

        ],
        [
            'text' => __('navigation/navigation.meetings'),
            'color' => '#57A770',
            'id' => 'meetings',
            'state' => $this->meetings_visibility
        ],
        [
            'text' => __('navigation/navigation.events'),
            'color' => '#6554B6',
            'id' => 'events',
            'state' => $this->events_visibility
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
                    wire:click="switchVisibility('{{ $item['id'] }}')"
                    class="flex flex-row gap-2.5 justify-center trans-all {{ $item['state'] ? 'opacity-100' : 'opacity-25' }}">
                <div class="h-6 w-12 rounded-sm"
                     style="background-color: {{ $item['color'] }}"></div>
                <span class="paragraph text-brown">{{$item['text']}}</span>
            </button>
        @endforeach
    </div>
</div>
