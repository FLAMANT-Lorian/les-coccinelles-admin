<?php

use App\Models\Meeting;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::livewire(LaravelLocalization::transRoute('routes.meetings'), 'pages::meetings.index')
    ->can('view-any', Meeting::class)
    ->name('meetings');
