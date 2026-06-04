<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::livewire(LaravelLocalization::transRoute('routes.calendar'), 'pages::calendar')
    ->can('calendar.index')
    ->name('calendar');
