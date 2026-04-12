@php
    $segments = [
        [
            'label' => __('navigation/navigation.dashboard')
        ],
    ]
@endphp

<div class="wrapper">
    {{-- BREADCRUMB --}}
    <x-general.breadcrumb
        :segments="$segments"/>
</div>
