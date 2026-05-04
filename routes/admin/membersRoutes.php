<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/members', 'pages::members.index')
    ->middleware('can:members.index')
    ->name('members.index');

Route::livewire('/members/create', 'pages::members.create')
    ->middleware('can:members.create')
    ->name('members.create');

Route::livewire('/members/{member}/update', 'pages::members.update')
    ->middleware('can:members.update')
    ->name('members.update');
