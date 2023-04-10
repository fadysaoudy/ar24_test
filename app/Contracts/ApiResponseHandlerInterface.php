<?php

namespace App\Contracts;

use App\Enum\AttachmentErrorEnum;
use App\Enum\DateErrorEnum;
use App\Enum\EmailErrorEnum;
use App\Enum\TokenErrorEnum;
use App\Enum\UserErrorEnum;

interface ApiResponseHandlerInterface
{
    public function handleJsonResponse($responseBody): void;
    public function getExceptionMessage(string $slug):TokenErrorEnum|UserErrorEnum|DateErrorEnum|AttachmentErrorEnum|EmailErrorEnum|string|null;

}
