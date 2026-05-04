<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/members/roles', 'pages::roles.index')
    ->middleware('can:roles.index')
    ->name('roles.index');

Route::livewire('/members/roles/create', 'pages::roles.create')
    ->middleware('can:roles.create')
    ->name('roles.create');
Route::livewire('/members/roles/{role}/update', 'pages::roles.update')
    ->middleware('can:roles.update')
    ->name('roles.update');
