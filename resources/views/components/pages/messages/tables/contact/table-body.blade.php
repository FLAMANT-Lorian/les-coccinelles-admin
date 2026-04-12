<tbody>
    @foreach($this->getContactMessages as $contactMessage)
        <x-pages.messages.tables.contact.tr :contactMessage="$contactMessage"/>
    @endforeach
</tbody>
