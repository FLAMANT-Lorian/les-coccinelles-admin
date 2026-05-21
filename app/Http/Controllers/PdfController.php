<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Carbon\Carbon;
use Spatie\LaravelPdf\PdfBuilder;
use function Spatie\LaravelPdf\Support\pdf;

class PdfController extends Controller
{
    public function generate(int $bookingId): PdfBuilder
    {
        $booking = Booking::with(['bookingDate', 'contact', 'hall_rate'])
            ->findOrFail($bookingId);

        $file_name = Carbon::now()->year . '-contrat-location-' . $booking->contact->last_name . '-' . $booking->contact->first_name . '-' . Carbon::parse($booking->bookingDate->start_date)->format('Y-m-d');

        return pdf()
            ->view('pdfs.contract.pages', ['booking' => $booking])
            ->name($file_name)
            ->download();
    }
}
