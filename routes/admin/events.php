<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Event;

Route::livewire(LaravelLocalization::transRoute('routes.events-index'), 'pages::events.index')
    ->can('view-any', Event::class)
    ->name('events.index');

Route::livewire(LaravelLocalization::transRoute('routes.events-show'), 'pages::events.show')
    ->can('view', Event::class)
    ->name('events.show');
