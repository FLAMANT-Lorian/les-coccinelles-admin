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
    MessageStatus::Read->value => 'Read',
    MessageStatus::Unread->value => 'Unread',

    // MembersRole
    RoleMode::Unique->value => 'Unique role',
    RoleMode::Multiple->value => 'Multiple roles',

    // YesOrNo
    YesOrNo::YES->value => 'Yes',
    YesOrNo::NO->value => 'No',

    // Sex
    Sex::male->value => 'Male',
    Sex::female->value => 'Female',
    Sex::other->value => 'Other',

    // MembersStatus
    MembersStatus::active->value => 'Active',
    MembersStatus::pause->value => 'On hold',
    MembersStatus::inactive->value => 'Inactive',

    // UtilityCostsStatus
    UtilityCostsStatus::upToDate->value => 'Up to date',
    UtilityCostsStatus::outOfDate->value => 'Out of date',

    // InterventionStatus
    InterventionStatus::todo->value => 'To do',
    InterventionStatus::done->value => 'Completed',

    // Member card
    MemberCardStatus::WITH_MEMBER_CARD->value => 'With card',
    MemberCardStatus::WITHOUT_MEMBER_CARD->value => 'Without card',

    // BOOKING
    BookingStatus::NOW->value => 'Ongoing',
    BookingStatus::PAST->value => 'Past',
    BookingStatus::SOON->value => 'Upcoming',

    //MEETING
    MeetingsStatus::PAST->value => 'Past',
    MeetingsStatus::SOON->value => 'Upcoming',

    // DEPOSIT STATUS
    DepositStatus::PAID->value => 'Paid',
    DepositStatus::UNPAID->value => 'Unpaid',

    // EVENTS
    EventStatus::NOW->value => 'Ongoing',
    EventStatus::PAST->value => 'Past',
    EventStatus::SOON->value => 'Upcoming',
];
