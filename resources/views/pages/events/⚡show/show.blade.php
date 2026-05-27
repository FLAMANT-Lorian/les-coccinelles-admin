@php
    use App\Enums\MessageTypes;

    $segments = [
        [
            'label' => __('navigation/navigation.events'),
            'url' => route('events.index')
        ],
        [
            'label' => $event->name
        ]
    ];
@endphp

<div class="wrapper">
    {{-- BREADCRUMB --}}
    <x-general.breadcrumb
        :segments="$segments"/>

    <div class="content">
        {{-- HEADING --}}
        <x-pages.events.show.heading
            :event="$event"/>
    </div>

    {{-- MODALS --}}
    @if($this->openEditModal)
        <x-widgets.modals.events.update-event/>
    @endif
</div>
