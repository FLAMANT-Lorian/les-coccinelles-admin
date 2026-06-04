<?php

$tabs = [
    [
        'label' => __('navigation/navigation.settings'),
        'location' => LaravelLocalization::localizeURL(route('settings')),
    ],
    [
        'label' => __('navigation/navigation.preferences'),
        'location' => LaravelLocalization::localizeURL(route('preferences')),
    ],
];

?>

<x-general.tabs
    :permission="false"
    :tabs="$tabs"/>
