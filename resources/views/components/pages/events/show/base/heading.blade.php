@php
    use App\Models\Event;
    /**
     * @var Event $event;
     */
@endphp

@props([
    'event'
])

<div
    class="col-span-full rl:grid rl:grid-cols-3 lg:grid-cols-2 rl:gap-8 w-full p-6 rounded-sm border border-beige-dark bg-beige-light">
    <div class="flex flex-col rl:col-span-2 lg:col-span-1">
        <h1 class="text-brown text-3xl lg:text-4.5xl font-semibold mb-4">
            {{ $event->name }}
        </h1>
        <div class="flex flex-row gap-x-6 gap-y-2 flex-wrap mb-6 rl:mb-8">
            @php
                $tags = [
                  'date' => [
                      'icon' => 'calendar',
                      'label' => formattedDate($event->start_date) . __('general.date-picker-format') . formattedDate($event->end_date)
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
                    <span class="tetx-base text-gray-600">{{ $tag['label'] }}</span>
                </div>
            @endforeach
        </div>
        <p class="paragraph">
            {{ $event->description }}
        </p>
    </div>
    @can('update', Event::class)
        <button type="button"
                wire:click="$dispatch('open-modal', { modal: 'openEditModal' })"
                class="max-rl:mt-6 rl:self-start rl:justify-self-end btn bg-brown border border-brown text-white hover:bg-transparent hover:text-brown">
            {{ __('pages/events.edit-event') }}
        </button>
    @endcan
</div>
