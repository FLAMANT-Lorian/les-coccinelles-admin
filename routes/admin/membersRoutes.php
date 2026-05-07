<?php

use Illuminate\Support\Facades\Route;

Route::livewire(LaravelLocalization::transRoute('routes.members'), 'pages::members.index')
    ->middleware('can:members.index')
    ->name('members.index');

Route::livewire(LaravelLocalization::transRoute('routes.members-create'), 'pages::members.create')
    ->middleware('can:members.create')
    ->name('members.create');

Route::livewire(LaravelLocalization::transRoute('routes.members-edit'), 'pages::members.update')
    ->middleware('can:members.update')
    ->name('members.update');
