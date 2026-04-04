<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/' . app()->getLocale());
});

Route::prefix('{locale}')->middleware([SetLocale::class, 'auth'])->group(function () {
    Route::livewire('/', 'pages::dashboard')->name('dashboard');
});
