<tbody>
    @foreach($this->getContactMessages as $contactMessage)
        <x-pages.messages.table.tr :contactMessage="$contactMessage"/>
    @endforeach
</tbody>
