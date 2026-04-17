<?php


use App\Enums\MembersStatus;
use App\Enums\MessageStatus;
use App\Enums\RoleMode;
use App\Enums\YesOrNo;

return [
    // MessageStatus
    MessageStatus::Read->value => 'Lu',
    MessageStatus::Unread->value => 'Non lu',

    // MembersRole
    RoleMode::Unique->value => 'Role unique',
    RoleMode::Multiple->value => 'Role multiple',

    // YesOrNo
    YesOrNo::YES->value => 'Oui',
    YesOrNo::NO->value => 'Non',

    // MembersStatus
    MembersStatus::active->value => 'Actif',
    MembersStatus::pause->value => 'Pause',
    MembersStatus::inactive->value => 'Inactif',
];
