<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/' . app()->getLocale());
});

Route::prefix('{locale}')->middleware([SetLocale::class, 'auth'])->group(function () {
    Route::livewire('/', 'pages::dashboard')->name('dashboard');

    /* MESSAGES */
    Route::livewire('/messages', 'pages::messages.index')->name('messages');

    /* MEMBERS */
    Route::livewire('/members', 'pages::members.index')->name('members.index');
    Route::livewire('/members/create', 'pages::members.create')->name('members.create');
    Route::livewire('/members/role/create', 'pages::roles.create')->name('roles.create');
});
