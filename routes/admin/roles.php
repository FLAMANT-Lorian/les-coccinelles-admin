<?php

use App\Models\Role;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::livewire(LaravelLocalization::transRoute('routes.roles'), 'pages::roles.index')
    ->can('view-any', Role::class)
    ->name('roles.index');

Route::livewire(LaravelLocalization::transRoute('routes.roles-create'), 'pages::roles.create')
    ->can('create', Role::class)
    ->name('roles.create');

Route::livewire(LaravelLocalization::transRoute('routes.roles-edit'), 'pages::roles.edit')
    ->can('update', Role::class)
    ->name('roles.edit');
