<?php

$tabs = [
    [
        'label' => __('navigation/navigation.availabilities'),
        'location' => route('availabilities', ['locale' => app()->getLocale()]),
        'permission' => 'availabilities.index'
    ],
    [
        'label' => __('navigation/navigation.hall-rates'),
        'location' => route('hall-rates', ['locale' => app()->getLocale()]),
        'permission' => 'hallRates.index'
    ],
    [
        'label' => __('navigation/navigation.utility-costs'),
        'location' => route('utility-costs', ['locale' => app()->getLocale()]),
        'permission' => null
    ],
];

?>

<x-general.tabs
    :tabs="$tabs"/>
