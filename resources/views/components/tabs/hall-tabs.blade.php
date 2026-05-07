<?php

$tabs = [
    [
        'label' => __('navigation/navigation.availabilities'),
        'location' => route('availabilities'),
        'permission' => 'availabilities.index'
    ],
    [
        'label' => __('navigation/navigation.hall-rates'),
        'location' => route('hall-rates'),
        'permission' => 'hallRates.index'
    ],
    [
        'label' => __('navigation/navigation.utility-costs'),
        'location' => route('utility-costs'),
        'permission' => 'utilityCosts.index'
    ],
    [
        'label' => __('navigation/navigation.interventions'),
        'location' => route('interventions'),
        'permission' => null
    ],
];

?>

<x-general.tabs
    :tabs="$tabs"/>
