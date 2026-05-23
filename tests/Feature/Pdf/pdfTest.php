<?php

use App\Models\Booking;
use App\Models\BookingDate;
use App\Models\Contact;
use App\Models\HallRate;
use App\Models\MeterReading;
use App\Models\User;
use Database\Seeders\UtilityCostSeeder;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\LaravelPdf\PdfBuilder;

it('verifies if you can generate a contract for a booking', function () {
    Pdf::fake();

    $booking = Booking::factory()
        ->contact(Contact::factory()->create())
        ->type(HallRate::factory()->create())
        ->has(MeterReading::factory())
        ->has(BookingDate::factory())
        ->create();

    $this->actingAs(User::factory()->create())
        ->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])
        ->get(route('pdf.generate.contract', ['bookingId' => $booking->id]))
        ->assertOk();

    Pdf::assertRespondedWithPdf(function (PdfBuilder $pdf) use ($booking) {
        return $pdf->downloadName === 'contrat-location-' . $booking->uniqid . '.pdf'
            && $pdf->isDownload()
            && $pdf->contains('Contrat');
    });
});

it('verifies if you can generate a count for a booking', function () {
    Pdf::fake();

    $this->seed(UtilityCostSeeder::class);

    $booking = Booking::factory()
        ->contact(Contact::factory()->create())
        ->type(HallRate::factory()->create())
        ->has(MeterReading::factory())
        ->has(BookingDate::factory())
        ->create();

    $this->actingAs(User::factory()->create())
        ->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])
        ->get(route('pdf.generate.count', ['bookingId' => $booking->id]))
        ->assertOk();

    Pdf::assertRespondedWithPdf(function (PdfBuilder $pdf) use ($booking) {
        return $pdf->downloadName === 'decompte-' . $booking->uniqid . '.pdf'
            && $pdf->isDownload()
            && $pdf->contains('Décompte');
    });
});

it('verifies if you can generate an invoice for a booking', function () {
    Pdf::fake();

    $this->seed(UtilityCostSeeder::class);

    $booking = Booking::factory()
        ->contact(Contact::factory()->create())
        ->type(HallRate::factory()->create())
        ->has(MeterReading::factory())
        ->has(BookingDate::factory())
        ->create();

    $this->actingAs(User::factory()->create())
        ->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ])
        ->get(route('pdf.generate.invoice', ['bookingId' => $booking->id]))
        ->assertOk();

    Pdf::assertRespondedWithPdf(function (PdfBuilder $pdf) use ($booking) {
        return $pdf->downloadName === 'facture-' . $booking->uniqid . '.pdf'
            && $pdf->isDownload()
            && $pdf->contains('Facture');
    });
});
