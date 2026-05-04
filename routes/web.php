<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/' . app()->getLocale());
});

Route::prefix('{locale}')->middleware([SetLocale::class, 'auth'])->group(function () {
    Route::livewire('/', 'pages::dashboard')->name('dashboard');

    /* MESSAGES */
    require __DIR__ . '/admin/messagesRoutes.php';

    /* MEMBERS */
    require __DIR__ . '/admin/membersRoutes.php';

    /* ROLES */
    require __DIR__ . '/admin/rolesRoutes.php';

    /* HALL */
    require __DIR__ . '/admin/hallRoutes.php';
});
