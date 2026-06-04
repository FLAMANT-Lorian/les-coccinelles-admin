<tbody>
    @foreach($this->getBookings as $booking)
        <x-pages.bookings.table.tr :booking="$booking"/>
    @endforeach
</tbody>
