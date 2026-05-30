<?php

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Event;

new class extends Component {

    public Event $event;

    public function mount(): void
    {
        $this->event = Event::orderBy('start_date')
            ->first();
    }
};
?>

<section class="col-span-full rl:col-span-2 lg:col-span-7 p-4 rounded-sm border border-beige-dark/60 bg-beige-light">
    <div class="flex flex-row items-center justify-between pb-4 border-b border-b-beige-dark/60">
        <h2 class="text-xl font-medium">{{ __('pages/dashboard.event.title') }}</h2>
        @can('view-any', Event::class)
            <a aria-label="{{ __('pages/dashboard.event.see_all') }}"
               href="{{ route('events.index') }}">
                <x-pages.dashboard.arrow/>
                <span class="sr-only">{{ __('pages/dashboard.event.see_all') }}</span>
            </a>
        @endcan
    </div>
    <div class="flex flex-col items-start gap-4">
        <h3 class="text-2xl font-semibold mt-4">{{$event->name}}</h3>
        <div class="flex flex-row gap-4 flex-wrap">
            @php
                $now = now();
                $start = Carbon::parse($event->start_date);
                $end = Carbon::parse($event->end_date);

                if ($now->between($start->startOfDay(), $end->endOfDay())) {
                    $text = __('pages/dashboard.event.today');
                } elseif ($end->endOfDay()->isPast()) {
                    $text = __('pages/dashboard.event.past');
                } else {
                    $days = $now->startOfDay()->diffInDays($start->startOfDay());
                    $text = __('pages/dashboard.event.in').
                        $days.
                        __('pages/dashboard.event.days');
                }

               $tags = [
                 'date' => [
                     'icon' => 'calendar',
                     'label' =>
                     '<time datetime="' . $event->start_date->format('Y-m-d') . '">' . formattedDate($event->start_date) .'</time>' .
                     __('general.date-picker-format') .
                    '<time datetime="' . $event->end_date->format('Y-m-d') . '">' . formattedDate($event->end_date) .'</time>' .
                     ' – ' . $text
                 ],
                 'map' => [
                     'icon' => 'map',
                     'label' => $event->address
                 ],
               ];
            @endphp
            @foreach($tags as $tag)
                <div class="flex flex-row items-center gap-2 px-2 py-1 rounded-sm bg-beige-medium">
                    <svg class="min-w-6 min-h-6 text-red" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <use href="#{{ $tag['icon'] }}"></use>
                    </svg>
                    <span class="tetx-base text-gray-600">{!! $tag['label'] !!}</span>
                </div>
            @endforeach
        </div>
        <p class="paragraph line-clamp-4">
            {{ $event->description }}
        </p>
        @can('update', Event::class)
            <a class="btn-small bg-brown text-white hover:bg-transparent hover:text-brown border border-brown"
               aria-label="{{ __('pages/dashboard.event.see_event') }}"
               href="{{ route('events.show', ['event' => $event->id]) }}">
                {{ __('pages/dashboard.event.see_event') }}
            </a>
        @endcan
    </div>
</section>
