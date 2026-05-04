<?php

$tabs = [
    [
        'label' => __('navigation/navigation.availabilities'),
        'location' => route('availabilities', ['locale' => app()->getLocale()]),
        'permission' => null
    ],
];

?>

<x-general.tabs
    :tabs="$tabs"/>
