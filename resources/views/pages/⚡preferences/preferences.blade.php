@php
    use App\Enums\MessageTypes;

    $segments = [
        [
            'label' => __('navigation/navigation.settings'),
            'url' => route('settings')
        ],
        [
            'label' => __('navigation/navigation.preferences')
        ],
    ];

    $heading = [
        'title' => __('pages/settings.preferences.heading'),
        'subtitle' => __('pages/settings.preferences.subtitle'),
    ];
@endphp

<div class="wrapper" x-data="{ modalOpen: false }">
    {{-- BREADCRUMB --}}
    <x-general.breadcrumb
        :segments="$segments"/>

    <div class="content">
        {{-- HEADING --}}
        <x-general.heading
            :heading="$heading"/>

        {{-- TAB --}}
        <x-tabs.settings-tabs/>

        {{-- PREFERENCES --}}
        <div class="grid lg:grid-cols-12 gap-8">
            {{-- NOTIFICATIONS --}}
            <livewire:pages.settings.preferences.notifications/>

            <span aria-hidden="true" class="col-span-full lg:col-span-1 justify-self-center h-px lg:h-full w-full lg:w-px bg-beige-dark/60"></span>

            {{-- LOCALE --}}
            <livewire:pages.settings.preferences.locale/>
        </div>
    </div>
</div>
