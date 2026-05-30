<div class="col-span-full flex flex-col rl:flex-row rl:justify-between rl:items-center gap-4 rl:gap-8">
    <h1 class="text-3xl rg:text-4.5xl font-semibold">{{ __('pages/dashboard.heading') }}</h1>
    <div class="flex flex-col gap-4 rg:flex-row">
        <x-pages.dashboard.fast-link
            icon="#calendar"
            color="#DBEAFE"
            :url="route('bookings.create')"
            :label="__('pages/dashboard.fast_links.1')"/>

        <x-pages.dashboard.fast-link
            icon="#meetings"
            color="#E3F0E7"
            :url="route('meetings', ['create' => true])"
            :label="__('pages/dashboard.fast_links.2')"/>

        <x-pages.dashboard.fast-link
            icon="#events"
            color="#E4DCF4"
            :url="route('events.index', ['create' => true])"
            :label="__('pages/dashboard.fast_links.3')"/>
    </div>
</div>
