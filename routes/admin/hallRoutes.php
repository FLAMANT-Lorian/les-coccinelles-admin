<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/availability-requests', 'pages::availabilities.index')
    ->middleware('can:availabilities.index')
    ->name('availabilities');

Route::livewire('/hall-rates', 'pages::hall-rates.index')
    ->middleware('can:hallRates.index')
    ->name('hall-rates');

Route::livewire('/utility-costs', 'pages::utility-costs.index')
    ->middleware('can:utilityCosts.index')
    ->name('utility-costs');

Route::livewire('/interventions', 'pages::interventions.index')
    ->name('interventions');
