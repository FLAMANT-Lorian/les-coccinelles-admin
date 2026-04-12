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

<div class="wrapper" x-data="{ modalOpen: false }">
    {{-- BREADCRUMB --}}
    <x-general.breadcrumb
        :segments="$segments"/>

    <div class="content">
        {{-- HEADING --}}
        <x-general.heading
            :heading="$heading"/>

        {{-- TABLE --}}
        <livewire:pages.messages.tables.contact.table/>
    </div>

    {{-- MODAL --}}
    @if($this->modalDeleteAll)
        <x-widgets.modals.delete-selection/>
    @elseif($this->modalViewMessage)
        <x-widgets.modals.view-message
        :message="$this->messageToSee"/>
    @endif

</div>
