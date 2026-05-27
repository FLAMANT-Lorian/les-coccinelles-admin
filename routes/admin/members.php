<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::livewire(LaravelLocalization::transRoute('routes.members'), 'pages::members.index')
    ->can('view-any', User::class)
    ->name('members.index');

Route::livewire(LaravelLocalization::transRoute('routes.members-create'), 'pages::members.create')
    ->can('create', User::class)
    ->name('members.create');

Route::livewire(LaravelLocalization::transRoute('routes.members-edit'), 'pages::members.edit')
    ->can('update', User::class)
    ->name('members.edit');
