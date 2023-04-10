<?php

namespace App\Enum;

enum ContentErrorEnum :string
{
    case CONTENT_EXCEEDS_LIMIT = 'Content parameters is too long';
    case FORBIDDEN_HTML = 'The content has some forbidden html tag into it, please clean your input ,The content has some forbidden html tag into it, please clean your input';
    case ERROR_NO_CONTENT_NO_ATTACHMENT = 'Empty mail , content is empty and there are no attachments';
}
