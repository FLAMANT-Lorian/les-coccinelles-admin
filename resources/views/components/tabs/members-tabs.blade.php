<?php

$tabs = [
    [
        'label' => __('pages/members.members'),
        'location' => LaravelLocalization::localizeURL(route('members.index')),
        'permission' => 'members.index'
    ],
    [
        'label' => __('pages/roles.role'),
        'location' => LaravelLocalization::localizeURL(route('roles.index')),
        'permission' => 'roles.index'
    ]
];

?>

<x-general.tabs
        :tabs="$tabs"/>
