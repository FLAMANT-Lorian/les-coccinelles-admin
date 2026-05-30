<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// EVENTS REMINDER
Schedule::command('events:send-event-reminders')->dailyAt('09:00');

// MEETINGS REMINDER
Schedule::command('meetings:send-meeting-reminders')->dailyAt('09:00');
