<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return redirect('/' . app()->getLocale());
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'auth']
],
    function () {
        Route::livewire('/', 'pages::dashboard')->name('dashboard');

        /* MESSAGES */
        require __DIR__ . '/admin/messagesRoutes.php';

        /* MEMBERS */
        require __DIR__ . '/admin/membersRoutes.php';

        /* ROLES */
        require __DIR__ . '/admin/rolesRoutes.php';

        /* HALL */
        require __DIR__ . '/admin/hallRoutes.php';

        /* CALENDAR */
        require __DIR__ . '/admin/calendar.php';
    });
