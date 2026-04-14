<?php


use App\Enums\MessageStatus;
use App\Enums\RoleMode;

return [
    // MessageStatus
    MessageStatus::Read->value => 'Lu',
    MessageStatus::Unread->value => 'Non lu',

    // MembersRole
    RoleMode::Unique->value => 'Role unique',
    RoleMode::Multiple->value => 'Role multiple',
];
