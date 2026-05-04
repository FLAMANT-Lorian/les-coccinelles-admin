<tbody>
    @foreach($this->getAvailabilityRequests as $availabilityRequest)
        <x-pages.availabilities.tables.contact.tr :availabilityRequest="$availabilityRequest"/>
    @endforeach
</tbody>
