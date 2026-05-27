<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
],
    function () {
        Route::livewire('/', 'pages::dashboard')->name('dashboard');

        /* MESSAGES */
        require __DIR__ . '/admin/messages.php';

        /* MEMBERS */
        require __DIR__ . '/admin/members.php';

        /* ROLES */
        require __DIR__ . '/admin/roles.php';

        /* HALL */
        require __DIR__ . '/admin/hall.php';

        /* CALENDAR */
        require __DIR__ . '/admin/calendar.php';

        /* SETTINGS */
        require __DIR__ . '/admin/settings.php';

        /* MEETINGS */
        require __DIR__ . '/admin/meetings.php';

        /* EVENTS */
        require __DIR__ . '/admin/events.php';
    });
