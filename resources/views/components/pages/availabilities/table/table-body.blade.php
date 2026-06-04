<tbody>
    @foreach($this->getAvailabilityRequests as $availabilityRequest)
        <x-pages.availabilities.table.tr :availabilityRequest="$availabilityRequest"/>
    @endforeach
</tbody>
