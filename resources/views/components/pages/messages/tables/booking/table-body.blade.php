<tbody>
    @foreach($this->getBookingMessages as $bookingMessage)
        <x-pages.messages.tables.booking.tr :bookingMessage="$bookingMessage"/>
    @endforeach
</tbody>
