<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/messages', 'pages::messages.index')
    ->middleware('can:messages.index')
    ->name('messages');
