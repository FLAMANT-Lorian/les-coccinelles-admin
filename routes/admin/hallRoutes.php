<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/availability-requests', 'pages::availabilities.index')
    ->middleware('can:availabilities.index')
    ->name('availabilities');

Route::livewire('/hall-rates', 'pages::hall-rates.index')
    ->middleware('can:hallRates.index')
    ->name('hall-rates');
