<?php

$tabs = [
    [
        'label' => __('navigation/navigation.settings'),
        'location' => LaravelLocalization::localizeURL(route('settings')),
    ],
];

?>

<x-general.tabs
    :permission="false"
    :tabs="$tabs"/>
