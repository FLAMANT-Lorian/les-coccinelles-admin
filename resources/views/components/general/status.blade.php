@php
    use App\Enums\MessageStatus;
@endphp

@props([
   'status'
])

@php
    $states  = [
        MessageStatus::Unread->value => 'bg-status-blue-light before:bg-status-blue',
        MessageStatus::Read->value => 'bg-status-green-light before:bg-status-green',
    ];

    $classes = $states[(string)$status];
@endphp

<span {!! $attributes->merge(['class' => $classes . ' ' . 'w-fit font-normal flex items-center gap-2 px-2 py-1 rounded-2xl before:block before:content[""] before:w-[0.625rem] before:h-[0.625rem] before:rounded-full']) !!}>
            {{ __('enums.' . $status) }}
</span>
