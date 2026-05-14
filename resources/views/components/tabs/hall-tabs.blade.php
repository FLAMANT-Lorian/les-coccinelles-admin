<?php

$tabs = [
    [
        'label' => __('navigation/navigation.availabilities'),
        'location' => LaravelLocalization::localizeURL(route('availabilities')),
        'permission' => 'availabilities.index'
    ],
    [
        'label' => __('navigation/navigation.bookings'),
        'location' => LaravelLocalization::localizeURL(route('bookings.index')),
        'permission' => 'bookings.index'
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
    [
        'label' => __('navigation/navigation.contacts'),
        'location' => LaravelLocalization::localizeURL(route('contacts')),
        'permission' => 'contacts.index'
    ],
];

?>

<x-general.tabs
    :tabs="$tabs"/>
