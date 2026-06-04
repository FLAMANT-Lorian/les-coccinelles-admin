<?php

use App\Models\Meeting;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;

new class extends Component {

    public Collection $meetings;

    public function mount(): void
    {
        $this->meetings = Meeting::where('date', '>=', now()->startOfDay())
            ->whereTime('hour', '>=', now()->format('H:i'))
            ->get();
    }
};
?>

<section class="col-span-full rl:col-span-2 lg:col-span-6 p-4 rounded-sm border border-beige-dark/60 bg-beige-light">
    <div class="flex flex-row items-center justify-between pb-4 border-b border-b-beige-dark/60">
        <h2 class="text-xl font-medium">{{ __('pages/dashboard.meetings.title') }}</h2>
        @can('view-any', Meeting::class)
            <a aria-label="{{ __('pages/dashboard.meetings.see_all') }}"
               href="{{ route('meetings') }}">
                <x-pages.dashboard.arrow/>
                <span class="sr-only">{{ __('pages/dashboard.meetings.see_all') }}</span>
            </a>
        @endcan
    </div>
    @if($this->meetings->isNotEmpty())
        <div class="flex flex-col text-brown divide-y divide-beige-dark/60 max-h-90 overflow-y-auto">
            @foreach($this->meetings as $meeting)
                <div class="flex flex-row items-center justify-between gap-4 py-4">
                    <div class="flex flex-col items-start gap-1">
                        @can('update', Meeting::class)
                            <a href="{{ route('meetings', ['meeting' => $meeting->id]) }}"
                               aria-label="{{ __('pages/dashboard.meetings.meeting') . $meeting->id }}"
                               title="{{ __('pages/dashboard.meetings.see_meeting') }}"
                               class="text-lg underline-link after:bg-brown">
                                {{ __('pages/dashboard.meetings.meeting') . $meeting->id }}
                            </a>
                        @else
                            <span class="text-lg">
                                {{ __('pages/dashboard.meetings.meeting') . $meeting->id }}
                            </span>
                        @endcan
                        <div class="flex flex-row items-center gap-2">
                            <time class="text-gray-600" datetime="{{ $meeting->date->format('Y-m-d') }}">
                                {{ formattedDate($meeting->date) }}
                            </time>
                            <span>–</span>
                            <time class="text-gray-600" datetime="{{ Carbon::parse($meeting->hour)->format('H:i') }}">
                                {{ Carbon::parse($meeting->hour)->format('H\hi') }}
                            </time>
                        </div>
                    </div>
                    @can('update', Meeting::class)
                        <a aria-label="{{ __('pages/dashboard.meetings.see_meeting') }}"
                           title="{{ __('pages/dashboard.meetings.see_meeting') }}"
                           href="{{ route('meetings', ['meeting' => $meeting->id]) }}">
                            <x-pages.dashboard.arrow/>
                            <span class="sr-only">{{ __('pages/dashboard.meetings.see_meeting') }}</span>
                        </a>
                    @endcan
                </div>
            @endforeach
        </div>
    @else
        <div class="flex items-center justify-center">
            <span
                class="text-red text-center mt-6 px-2 py-1 bg-status-red-light rounded-sm">
                {{ __('pages/dashboard.meetings.no_meetings') }}
            </span>
        </div>
    @endif
</section>
