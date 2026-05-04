<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/availability-requests', 'pages::availabilities.index')
    ->name('availabilities');
