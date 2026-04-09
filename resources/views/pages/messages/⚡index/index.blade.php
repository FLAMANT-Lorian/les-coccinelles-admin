@php
    use App\Enums\MessageTypes;

    $segments = [
        [
            'label' => __('navigation/navigation.messages')
        ],
    ];

    $heading = [
        'title' => __('pages/messages.heading'),
        'subtitle' => __('pages/messages.subtitle'),
    ];
@endphp

<div class="wrapper">
    {{-- BREADCRUMB --}}
    <x-general.breadcrumb
        :segments="$segments"/>

    <div class="content">
        {{-- HEADING --}}
        <x-general.heading
            :heading="$heading"/>

        {{-- TABLE --}}
        <x-pages.messages.table-layout/>
    </div>
</div>
