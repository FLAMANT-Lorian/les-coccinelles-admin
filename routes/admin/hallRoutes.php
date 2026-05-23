<?php

use App\Http\Controllers\PdfController;
use App\Models\AvailabilityRequest;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\HallRate;
use App\Models\Intervention;
use App\Models\UtilityCost;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::livewire(LaravelLocalization::transRoute('routes.availabilities'), 'pages::availabilities.index')
    ->can('view-any', AvailabilityRequest::class)
    ->name('availabilities');

Route::livewire(LaravelLocalization::transRoute('routes.hall-rates'), 'pages::hall-rates.index')
    ->can('view-any', HallRate::class)
    ->name('hall-rates');

Route::livewire(LaravelLocalization::transRoute('routes.utility-costs'), 'pages::utility-costs.index')
    ->can('view-any', UtilityCost::class)
    ->name('utility-costs');

Route::livewire(LaravelLocalization::transRoute('routes.interventions'), 'pages::interventions.index')
    ->can('view-any', Intervention::class)
    ->name('interventions');

Route::livewire(LaravelLocalization::transRoute('routes.contacts'), 'pages::contacts.index')
    ->can('view-any', Contact::class)
    ->name('contacts');

Route::livewire(LaravelLocalization::transRoute('routes.bookings'), 'pages::bookings.index')
    ->can('view-any', Booking::class)
    ->name('bookings.index');

Route::livewire(LaravelLocalization::transRoute('routes.bookings-create'), 'pages::bookings.create')
    ->can('create', Booking::class)
    ->name('bookings.create');

Route::livewire(LaravelLocalization::transRoute('routes.bookings-edit'), 'pages::bookings.edit')
    ->can('update', Booking::class)
    ->name('bookings.edit');

Route::get('/pdf/generate/contract/{bookingId}', [PdfController::class, 'generateContract'])
    ->name('pdf.generate.contract');

Route::get('/pdf/generate/count/{bookingId}', [PdfController::class, 'generateCount'])
    ->name('pdf.generate.count');
