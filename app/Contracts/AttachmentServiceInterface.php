<?php

namespace App\Contracts;

use App\Http\Requests\DTO\Attachment\AttachmentUploadRequest;

interface AttachmentServiceInterface
{
    public function store(AttachmentUploadRequest $request): string;
}
