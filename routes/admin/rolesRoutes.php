<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::livewire(LaravelLocalization::transRoute('routes.roles'), 'pages::roles.index')
    ->middleware('can:roles.index')
    ->name('roles.index');

Route::livewire(LaravelLocalization::transRoute('routes.roles-create'), 'pages::roles.create')
    ->middleware('can:roles.create')
    ->name('roles.create');

Route::livewire(LaravelLocalization::transRoute('routes.roles-edit'), 'pages::roles.edit')
    ->middleware('can:roles.update')
    ->name('roles.edit');
