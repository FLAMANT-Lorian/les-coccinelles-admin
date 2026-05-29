<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Schedule::command('events:send-event-reminders')->dailyAt('09:00');
