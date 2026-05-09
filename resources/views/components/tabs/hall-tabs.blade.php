<?php

$tabs = [
    [
        'label' => __('navigation/navigation.availabilities'),
        'location' =>LaravelLocalization::localizeURL( route('availabilities')),
        'permission' => 'availabilities.index'
    ],
    [
        'label' => __('navigation/navigation.hall-rates'),
        'location' => LaravelLocalization::localizeURL(route('hall-rates')),
        'permission' => 'hallRates.index'
    ],
    [
        'label' => __('navigation/navigation.utility-costs'),
        'location' => LaravelLocalization::localizeURL(route('utility-costs')),
        'permission' => 'utilityCosts.index'
    ],
    [
        'label' => __('navigation/navigation.interventions'),
        'location' => LaravelLocalization::localizeURL(route('interventions')),
        'permission' => 'interventions.index'
    ],
];

?>

<x-general.tabs
    :tabs="$tabs"/>
