<?php

use App\Models\Booking;
use App\Models\Intervention;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {

    #[Computed]
    public function getEvents(): array
    {
        $events = [];

        $bookings = Booking::with(['contact'])->get();
        $interventions = Intervention::all();

        foreach ($bookings as $booking) {
            $event = [
                'title' => 'Réservation salle – ' . $booking->contact->full_name,
                'start' => Carbon::parse($booking->start_date)->startOfDay()->format('Y-m-d\TH:i:s'),
                'end' => Carbon::parse($booking->end_date)->endOfDay()->format('Y-m-d\TH:i:s'),
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
                $event['url'] = route('interventions');
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
