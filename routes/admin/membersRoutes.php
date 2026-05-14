<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::livewire(LaravelLocalization::transRoute('routes.members'), 'pages::members.index')
    ->middleware('can:members.index')
    ->name('members.index');

Route::livewire(LaravelLocalization::transRoute('routes.members-create'), 'pages::members.create')
    ->middleware('can:members.create')
    ->name('members.create');

Route::livewire(LaravelLocalization::transRoute('routes.members-edit'), 'pages::members.edit')
    ->middleware('can:members.update')
    ->name('members.edit');
