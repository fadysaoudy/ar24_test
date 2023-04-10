<?php

namespace App\Enum;

enum DateErrorEnum: string
{
    case EMPTY_DATE = 'empty_date';
    case INVALID_DATE = 'invalid_date';
    case EXPIRED_DATE = 'expired_date';
    case DATE_IN_FUTURE = 'date_in_future';
}
