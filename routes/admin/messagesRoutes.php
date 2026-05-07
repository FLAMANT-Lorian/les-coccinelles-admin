<?php

use Illuminate\Support\Facades\Route;

Route::livewire(LaravelLocalization::transRoute('routes.messages'), 'pages::messages.index')
    ->middleware('can:messages.index')
    ->name('messages');
