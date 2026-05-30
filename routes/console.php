<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// EVENTS REMINDER
Schedule::command('events:send-event-reminders')->dailyAt('09:00');

// MEETINGS REMINDER
Schedule::command('meetings:send-meeting-reminders')->dailyAt('09:00');

// INTERVENTIONS REMINDER
Schedule::command('interventions:send-intervention-reminders')->dailyAt('09:00');
