<?php

namespace App\Enums;

enum MemberCardStatus: string
{
    case WITH_MEMBER_CARD = 'with_member_card';
    case WITHOUT_MEMBER_CARD = 'without_member_card';

    public function toBoolean(): bool
    {
        return $this === self::WITH_MEMBER_CARD;
    }
}
