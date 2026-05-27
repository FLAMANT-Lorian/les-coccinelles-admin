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

        {{-- DANGER ZONE --}}
        <x-pages.events.show.danger-zone/>
    </div>

    {{-- MODALS --}}
    @if($this->openEditModal)
        <x-widgets.modals.events.update-event/>
    @elseif($this->openDeleteModal)
        <x-widgets.modals.events.delete-event
            :id="$event->id"/>
    @endif
</div>
