<?php

namespace App\Console\Commands;

use App\Enums\InterventionStatus;
use App\Mail\EventReminderMail;
use App\Mail\InterventionReminderMail;
use App\Models\Event;
use App\Models\Intervention;
use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

#[Signature('interventions:send-intervention-reminders')]
#[Description('Command description')]
class SendInterventionReminders extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $next_week = now()->addDays(7);
        $interventions = Intervention::whereDate('deadline', $next_week)
            ->where('status', InterventionStatus::todo->value)
            ->get();

        $count = 0;

        foreach ($interventions as $intervention) {
            if ($intervention->assignee->notifications['interventions']) {
                Mail::to($intervention->assignee->email)->send(new InterventionReminderMail($intervention));
                $count++;
            }
        }

        $this->info($count . ' rappel(s) envoyé(s).');
    }
}
