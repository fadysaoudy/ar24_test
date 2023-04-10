<?php

namespace App\Enum;

enum EmailErrorEnum: string
{
    case MISSING_EMAIL = 'Please specify an email address ';
    case SAME_SENDER_RECIPIENT_EMAILS = 'Recipient email and sender email must be different';
    case INVALID_RECIPIENT = 'invalid_recipient';
    case INVALID_EMAIL= "Recipient's email address is incorrect, the domain does not exist";
    case GROUP_NOTE_EXIST = 'Group ID provided does not exist';
}
