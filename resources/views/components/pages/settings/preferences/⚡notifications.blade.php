<?php

use Livewire\Component;

new class extends Component {

    public array $notifications;

    public function mount(): void
    {
        $this->notifications = auth()->user()->notifications;
    }

    public function updatedNotifications(): void
    {
        auth()->user()->update([
            'notifications' => $this->notifications,
        ]);
    }

};
?>


<div class="lg:col-span-5">
    <h3 class="text-2xl font-medium mb-1">{{ __('pages/settings.preferences.notifications-title') }}</h3>
    <p class="paragraph text-gray-500 mb-6">{!! __('pages/settings.preferences.notifications-text') !!}</p>
    <div class="flex flex-col gap-2">

        <x-forms.input.input-checkbox
            :label="__('forms.notifications.messages')"
            name="notifications[messages]"
            :required="true"
            field_name="notifications_messages"
            wire="notifications.messages"
        />

        <x-forms.input.input-checkbox
            :label="__('forms.notifications.events')"
            name="notifications[events]"
            :required="true"
            field_name="notifications_events"
            wire="notifications.events"
        />

        <x-forms.input.input-checkbox
            :label="__('forms.notifications.bookings')"
            name="notifications[bookings]"
            :required="true"
            field_name="notifications_bookings"
            wire="notifications.bookings"
        />

        <x-forms.input.input-checkbox
            :label="__('forms.notifications.meetings')"
            name="notifications[meetings]"
            :required="true"
            field_name="notifications_meetings"
            wire="notifications.meetings"
        />

        <x-forms.input.input-checkbox
            :label="__('forms.notifications.interventions')"
            name="notifications[interventions]"
            :required="true"
            field_name="notifications_interventions"
            wire="notifications.interventions"
        />

    </div>
</div>
