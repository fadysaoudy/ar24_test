<?php

namespace App\Enum;

enum TokenErrorEnum: string
{
    case TOKEN_INVALID = 'token_invalid';
    case TOKEN_MISSING = 'token_missing';
    case EMPTY_DATE = 'empty_date';
}
