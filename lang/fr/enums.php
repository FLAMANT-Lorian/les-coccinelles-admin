<?php


use App\Enums\BookingStatus;
use App\Enums\DepositStatus;
use App\Enums\EventStatus;
use App\Enums\InterventionStatus;
use App\Enums\MeetingsStatus;
use App\Enums\MemberCardStatus;
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

    // InterventionStatus
    InterventionStatus::todo->value => 'À faire',
    InterventionStatus::done->value => 'Terminée',

    // Member card
    MemberCardStatus::WITH_MEMBER_CARD->value => 'Avec carte',
    MemberCardStatus::WITHOUT_MEMBER_CARD->value => 'Sans carte',

    // BOOKING
    BookingStatus::NOW->value => 'En cours',
    BookingStatus::PAST->value => 'Passée',
    BookingStatus::SOON->value => 'Bientôt',

    //MEETING
    MeetingsStatus::PAST->value => 'Passée',
    MeetingsStatus::SOON->value => 'Bientôt',

    // DEPOSIT STATUS
    DepositStatus::PAID->value => 'Payée',
    DepositStatus::UNPAID->value => 'Non payée',

    // EVENTS
    EventStatus::NOW->value => 'En cours',
    EventStatus::PAST->value => 'Passée',
    EventStatus::SOON->value => 'Bientôt',
];
