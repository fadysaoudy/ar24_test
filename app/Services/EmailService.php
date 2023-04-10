<?php

namespace App\Services;
use App\Contracts\EmailServiceInterface;
use App\Contracts\HttpWrapperInterface;
use App\Http\Requests\DTO\Email\EmailGetInfoRequest;
use App\Http\Requests\DTO\Email\EmailSendRequest;
use Exception;
use Illuminate\Support\Facades\Log;

class EmailService implements EmailServiceInterface
{

    public function __construct(protected HttpWrapperInterface $httpWrapper)
    {

    }

    /**
     * @param EmailSendRequest $request
     * @throws Exception
     */
    public function store(EmailSendRequest $request)
    {
        $headers = ['Content-Type' => 'multipart/form-data'];
        try {
            $this->httpWrapper->post('/mail/', $request, $headers, true);

        } catch (Exception $e) {
            Log::error($e);
            throw new Exception($e->getMessage());
        }

    }


    /**
     * @param EmailGetInfoRequest $request
     * @return void
     * @throws Exception
     */
    public function get(EmailGetInfoRequest $request)
    {
        $headers = ['Content-Type' => 'application/x-www-form-urlencoded'];

        try {
            $this->httpWrapper->get('/mail', $request, $headers);


        } catch (Exception $e) {
            Log::error($e);
            throw new Exception($e->getMessage());
        }

    }
}
