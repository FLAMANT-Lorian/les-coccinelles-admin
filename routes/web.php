<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/' . app()->getLocale());
});

Route::prefix('{locale}')->middleware([SetLocale::class, 'auth'])->group(function () {
    Route::livewire('/', 'pages::dashboard')->name('dashboard');

    /* MESSAGES */
    Route::livewire('/messages', 'pages::messages.index')
        ->middleware('can:messages.index')
        ->name('messages');

    /* MEMBERS */
    Route::livewire('/members', 'pages::members.index')
        ->middleware('can:members.index')
        ->name('members.index');

    Route::livewire('/members/create', 'pages::members.create')
        ->middleware('can:members.create')
        ->name('members.create');

    Route::livewire('/members/{member}/update', 'pages::members.update')
        ->middleware('can:members.update')
        ->name('members.update');

    /* ROLES */
    Route::livewire('/members/roles', 'pages::roles.index')
        ->middleware('can:roles.index')
        ->name('roles.index');

    Route::livewire('/members/roles/create', 'pages::roles.create')
        ->middleware('can:roles.create')
        ->name('roles.create');
    Route::livewire('/members/roles/{role}/update', 'pages::roles.update')
        ->middleware('can:roles.update')
        ->name('roles.update');
});
