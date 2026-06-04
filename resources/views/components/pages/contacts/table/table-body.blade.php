<tbody>
    @foreach($this->getContacts as $contact)
        <x-pages.contacts.table.tr :contact="$contact"/>
    @endforeach
</tbody>
