<?php

use App\Models\AvailabilityRequest;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\HallRate;
use App\Models\Intervention;
use App\Models\UtilityCost;

$tabs = [
    [
        'label' => __('navigation/navigation.availabilities'),
        'location' => LaravelLocalization::localizeURL(route('availabilities')),
        'model' => AvailabilityRequest::class
    ],
    [
        'label' => __('navigation/navigation.bookings'),
        'location' => LaravelLocalization::localizeURL(route('bookings.index')),
        'model' => Booking::class
    ],
    [
        'label' => __('navigation/navigation.hall-rates'),
        'location' => LaravelLocalization::localizeURL(route('hall-rates')),
        'model' => HallRate::class
    ],
    [
        'label' => __('navigation/navigation.utility-costs'),
        'location' => LaravelLocalization::localizeURL(route('utility-costs')),
        'model' => UtilityCost::class
    ],
    [
        'label' => __('navigation/navigation.interventions'),
        'location' => LaravelLocalization::localizeURL(route('interventions')),
        'model' => Intervention::class
    ],
    [
        'label' => __('navigation/navigation.contacts'),
        'location' => LaravelLocalization::localizeURL(route('contacts')),
        'model' => Contact::class
    ],
];

?>

<x-general.tabs
    :tabs="$tabs"/>
