<?php

namespace App\Traits;

use App\Models\Booking;
use Livewire\Attributes\On;

trait DeleteBooking
{
    #[On('delete-booking')]
    public function deleteBooking(int $id): void
    {
        $this->authorize('delete', Booking::class);

        $booking = Booking::findOrFail($id);

        $booking->delete();

        session()->flash('success', __('flash-messages.booking-deleted'));

        $this->redirectRoute('bookings.index', navigate: true);
    }
}
