@php
    use App\Enums\MessageTypes;

    $segments = [
        [
            'label' => __('navigation/navigation.meetings')
        ],
    ];

    $heading = [
        'title' => __('pages/meetings.heading'),
        'subtitle' => __('pages/meetings.subtitle'),
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

        {{-- TABLE --}}
        <livewire:pages.meetings.table.table/>
    </div>

    {{-- MODAL --}}
    @if($this->openCreateModal)
        <x-widgets.modals.meetings.create-meeting/>
    @endif
</div>
