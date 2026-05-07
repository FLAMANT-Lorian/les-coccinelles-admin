<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::livewire(LaravelLocalization::transRoute('routes.messages'), 'pages::messages.index')
    ->middleware('can:messages.index')
    ->name('messages');
