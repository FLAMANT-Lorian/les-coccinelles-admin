@php
    use App\Enums\MessageTypes;

     $tabs = [
        [
            'label' => 'Messages',
            'location' => MessageTypes::contact->value,
        ],
        [
            'label' => 'Demande de disponibilité',
            'location' => MessageTypes::booking->value,
        ],
    ];
@endphp

<div>
    <x-general.tabs
        :tabs="$tabs"/>

    @if($this->tab === MessageTypes::contact->value)
        <livewire:pages.messages.tables.contact.table/>
    @elseif($this->tab === MessageTypes::booking->value)
        <livewire:pages.messages.tables.booking.table/>
    @endif
</div>
