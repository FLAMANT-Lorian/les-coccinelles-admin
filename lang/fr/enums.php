<?php


use App\Enums\MembersStatus;
use App\Enums\MessageStatus;
use App\Enums\RoleMode;
use App\Enums\Sex;
use App\Enums\UtilityCostsStatus;
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

    // Sex
    Sex::male->value => 'Homme',
    Sex::female->value => 'Femme',
    Sex::other->value => 'Autre',

    // MembersStatus
    MembersStatus::active->value => 'Actif',
    MembersStatus::pause->value => 'Pause',
    MembersStatus::inactive->value => 'Inactif',

    // UtilityCostsStatus
    UtilityCostsStatus::upToDate->value => 'À jour',
    UtilityCostsStatus::outOfDate->value => 'Pas à jour',
];
