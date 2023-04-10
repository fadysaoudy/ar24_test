<?php

namespace App\Enum;

enum AttachmentErrorEnum: string
{
    case ATTACHMENT_EMPTY_NAME = 'attachment_empty_name';
    case ATTACHMENT_TOO_BIG = "We can't extract a file name for the uploaded file (file_name parameter or name parameter in the file object are empty or wrong encoded)";
    case ATTACHMENT_MISSING_FILE = 'attachment_missing_file';
    case ATTACHMENT_NOT_EXISTS = "At least one of the attachment ID's you proviced doesn't exist";
    case ATTACHMENT_UNAVAILABLE = "One of the attachment ID's you provided doesn't exist";


}
