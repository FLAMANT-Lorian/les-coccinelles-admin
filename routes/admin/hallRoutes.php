<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/availability-requests', 'pages::availability.index')
    ->name('availability.index');
