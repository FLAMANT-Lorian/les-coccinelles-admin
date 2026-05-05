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
        <livewire:pages.messages.table.table/>
    </div>

    {{-- MODAL --}}
    @if($this->modalDeleteAll)
        <x-widgets.modals.selection.delete-selection
            action="deleteMessages"/>
    @elseif($this->modalViewMessage)
        <x-widgets.modals.messages.view-message
            :message="$this->messageToSee"/>
    @elseif($this->modalDeleteMessage)
        <x-widgets.modals.messages.delete-message
            :id="$this->messageToDelete"/>
    @endif

</div>
