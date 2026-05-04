<?php

$tabs = [
    [
        'label' => __('navigation/navigation.availabilities'),
        'location' => route('availabilities.index', ['locale' => app()->getLocale()]),
        'permission' => null
    ],
];

?>

<x-general.tabs
    :tabs="$tabs"/>
