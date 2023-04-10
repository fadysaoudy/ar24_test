<?php

namespace App\Enum;

enum ResponseEnum: string
{
    case Unknown = 'Unknown';

    case Error = 'ERROR';

    case SUCCESS = 'SUCCESS';

    case Unhandled = 'Unhandled';
}
