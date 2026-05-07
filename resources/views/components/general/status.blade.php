@php
    use App\Enums\InterventionStatus;use App\Enums\MembersStatus;
    use App\Enums\MessageStatus;
    use App\Enums\UtilityCostsStatus;
@endphp

@props([
   'status'
])

@php
    $states  = [
        // MESSAGES
        MessageStatus::Unread->value => 'bg-status-blue-light before:bg-status-blue',
        MessageStatus::Read->value => 'bg-status-green-light before:bg-status-green',

        // MEMBERS
        MembersStatus::active->value => 'bg-status-green-light before:bg-status-green',
        MembersStatus::pause->value => 'bg-status-blue-light before:bg-status-blue',
        MembersStatus::inactive->value => 'bg-status-red-light before:bg-status-red',

        // UTILITY COSTS
        UtilityCostsStatus::upToDate->value => 'bg-status-green-light before:bg-status-green',
        UtilityCostsStatus::outOfDate->value => 'bg-status-red-light before:bg-status-red',

        // INTERVENTIONS
        InterventionStatus::todo->value => 'bg-status-blue-light before:bg-status-blue',
        InterventionStatus::done->value => 'bg-status-green-light before:bg-status-green',
    ];

    $classes = $states[(string)$status];
@endphp

<span {!! $attributes->merge(['class' => $classes . ' ' . 'w-fit font-normal flex items-center gap-2 px-2 py-1 rounded-2xl before:block before:content[""] before:w-2.5 before:h-2.5 before:rounded-full']) !!}>
            {{ __('enums.' . $status) }}
</span>
