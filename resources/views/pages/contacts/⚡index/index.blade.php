@php
    use App\Enums\MessageTypes;

    $segments = [
        [
            'label' => __('navigation/navigation.contacts')
        ],
    ];

    $heading = [
        'title' => __('pages/hall.contacts.heading'),
        'subtitle' => __('pages/hall.contacts.subtitle'),
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

        {{-- TABS --}}
        <x-tabs.hall-tabs/>

        {{-- TABLE --}}
        <livewire:pages.contacts.table.table/>
    </div>

    {{-- MODALS --}}
    @if($this->openCreateModal)
        <x-widgets.modals.contacts.create-contact/>
    @elseif($this->openUpdateModal)
        <x-widgets.modals.contacts.update-contact/>
    @endif
</div>
