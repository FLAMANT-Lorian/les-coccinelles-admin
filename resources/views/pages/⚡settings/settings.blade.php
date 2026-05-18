@php
    use App\Enums\MessageTypes;

    $segments = [
        [
            'label' => __('navigation/navigation.settings')
        ],
    ];

    $heading = [
        'title' => __('pages/settings.settings.heading'),
        'subtitle' => __('pages/settings.settings.subtitle'),
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

        {{-- FORM --}}
        <livewire:pages.settings.settings.form/>

        {{-- CHANGE PASSWORD --}}
        <livewire:pages.settings.settings.change-password-form/>
    </div>
</div>
