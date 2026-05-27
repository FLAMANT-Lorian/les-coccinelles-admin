<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::livewire(LaravelLocalization::transRoute('routes.events-index'), 'pages::events.index')
    ->name('events.index');

Route::livewire(LaravelLocalization::transRoute('routes.events-show'), 'pages::events.show')
    ->name('events.show');
