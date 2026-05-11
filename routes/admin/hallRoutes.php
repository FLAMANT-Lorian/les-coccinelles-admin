<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::livewire(LaravelLocalization::transRoute('routes.availabilities'), 'pages::availabilities.index')
    ->middleware('can:availabilities.index')
    ->name('availabilities');

Route::livewire(LaravelLocalization::transRoute('routes.hall-rates'), 'pages::hall-rates.index')
    ->middleware('can:hallRates.index')
    ->name('hall-rates');

Route::livewire(LaravelLocalization::transRoute('routes.utility-costs'), 'pages::utility-costs.index')
    ->middleware('can:utilityCosts.index')
    ->name('utility-costs');

Route::livewire(LaravelLocalization::transRoute('routes.interventions'), 'pages::interventions.index')
    ->middleware('can:interventions.index')
    ->name('interventions');

Route::livewire(LaravelLocalization::transRoute('routes.contacts'), 'pages::contacts.index')
    ->middleware('can:contacts.index')
    ->name('contacts');

Route::livewire(LaravelLocalization::transRoute('routes.bookings'), 'pages::bookings.index')
    ->name('bookings.index');

