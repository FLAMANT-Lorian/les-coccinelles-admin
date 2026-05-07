<?php

$tabs = [
    [
        'label' => __('pages/members.members'),
        'location' => route('members.index'),
        'permission' => 'members.index'
    ],
    [
        'label' => __('pages/roles.role'),
        'location' => route('roles.index'),
        'permission' => 'roles.index'
    ]
];

?>

<x-general.tabs
    :tabs="$tabs"/>
