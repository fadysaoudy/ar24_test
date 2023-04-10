<?php

namespace App\Services;

use App\Contracts\AttachmentServiceInterface;
use App\Contracts\HttpWrapperInterface;
use App\Http\Requests\DTO\Attachment\AttachmentUploadRequest;
use Exception;
use Illuminate\Support\Facades\Log;

class AttachmentService implements AttachmentServiceInterface
{
    public function __construct(protected HttpWrapperInterface $httpWrapper)
    {

    }

    /**
     * @throws Exception
     */
    public function store(AttachmentUploadRequest $request): string
    {
        try {
            $headers = ['Content-Type' => 'multipart/form-data'];
            $response = $this->httpWrapper->post('/attachment', $request, $headers, true);
        }
        catch (Exception $e) {
            Log::error($e);
            throw new Exception($e->getMessage());
        }

        return $response;

    }
}
