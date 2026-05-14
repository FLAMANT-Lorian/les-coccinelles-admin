<?php

use App\Models\Message;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::livewire(LaravelLocalization::transRoute('routes.messages'), 'pages::messages.index')
    ->can('view-any', Message::class)
    ->name('messages');
