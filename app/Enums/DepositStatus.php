<?php

namespace App\Enums;

enum DepositStatus: string
{
    case PAID = 'paid';
    case UNPAID = 'unpaid';
}
