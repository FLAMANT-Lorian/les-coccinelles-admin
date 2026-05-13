<?php

use App\Models\Booking;
use Livewire\Component;

new class extends Component {

    public Booking $booking;

    public function mount(Booking $booking): void
    {
        $this->booking = $booking;
    }
};
