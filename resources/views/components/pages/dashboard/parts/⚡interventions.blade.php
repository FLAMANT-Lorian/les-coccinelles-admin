<?php

use App\Enums\InterventionStatus;
use App\Models\Intervention;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;

new class extends Component {

    public Collection $interventions;

    public function mount(): void
    {
        $this->interventions = Intervention::with(['assignee'])
            ->where('status', InterventionStatus::todo->value)
            ->get();
    }
};
?>

<section class="col-span-full rl:col-span-2 lg:col-span-6 p-4 rounded-sm border border-beige-dark/60 bg-beige-light">
    <div class="flex flex-row items-center justify-between pb-4 border-b border-b-beige-dark/60">
        <h2 class="text-xl font-medium">{{ __('pages/dashboard.interventions.title') }}</h2>
        @can('view-any', Intervention::class)
            <a aria-label="{{ __('pages/dashboard.interventions.see_all') }}"
               href="{{ route('interventions') }}">
                <x-pages.dashboard.arrow/>
                <span class="sr-only">{{ __('pages/dashboard.interventions.see_all') }}</span>
            </a>
        @endcan
    </div>
    @if($this->interventions->isNotEmpty())
        <div class="flex flex-col text-brown divide-y divide-beige-dark/60 max-h-90 overflow-y-auto">
            @foreach($this->interventions as $intervention)
                <div class="flex flex-row items-center justify-between gap-4 py-4">
                    <div class="flex flex-col items-start gap-2">
                        @can('update', Intervention::class)
                            <a href="{{ route('interventions', ['intervention' => $intervention->id]) }}"
                               aria-label="{{ $intervention->name }}"
                               title="{{ __('pages/dashboard.interventions.see_intervention') }}"
                               class="text-lg underline-link after:bg-brown">
                                {{ $intervention->name }}
                            </a>
                        @else
                            <span class="text-lg">
                                {{ $intervention->name }}
                            </span>
                        @endcan
                        <div class="flex flex-row flex-wrap gap-2 text-sm text-gray-600">
                            <time class="pr-2 border-r border-r-beige-dark/60"
                                  datetime="{{ $intervention->deadline->format('Y-m-d') }}">
                                {{ formattedDate($intervention->deadline) }}
                            </time>
                            @if($intervention->assignee)
                                <span>{{ __('pages/dashboard.interventions.assign_to') . $intervention->assignee->full_name }}</span>
                            @else
                                <span class="italic">{{ __('general.not-assigned') }}</span>
                            @endif
                        </div>
                    </div>
                    <x-general.status
                        :status="$intervention->status"/>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex items-center justify-center">
            <span
                class="text-red text-center mt-6 px-2 py-1 bg-status-red-light rounded-sm">
                {{ __('pages/dashboard.interventions.no_interventions') }}
            </span>
        </div>
    @endif
</section>
