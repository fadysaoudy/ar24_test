<?php

namespace App\Services;

use App\Contracts\HttpWrapperInterface;
use App\Contracts\UserServiceInterface;
use App\Http\Requests\DTO\User\UserCreateRequest;
use App\Http\Requests\DTO\User\UserGetRequest;
use Exception;
use Illuminate\Support\Facades\Log;
use stdClass;

class UserService implements UserServiceInterface
{
    public function __construct(protected HttpWrapperInterface $httpWrapper)
    {

    }

    /**
     * @throws Exception
     */
    public function store(UserCreateRequest $request): void
    {

        $headers = ['Content-Type' => 'application/x-www-form-urlencoded'];
        try {
            $this->httpWrapper->post('/user', $request, $headers);

        }
        catch (Exception $e) {
            Log::error($e);
            throw new Exception($e->getMessage());
        }


    }

    /**
     * @throws Exception
     */
    public function get(UserGetRequest $request):stdClass
    {

        $headers = ['Content-Type' => 'application/x-www-form-urlencoded'];
        try {
            $response = $this->httpWrapper->get('/user', $request, $headers);
            $cleanedResponse = substr($response, stripos($response, "result") - 1);
            $cleanedResponse = "{" . $cleanedResponse;
            $cleanedResponse = json_decode($cleanedResponse);
            $cleanedResponse = collect($cleanedResponse);
            $cleanedResponse = $cleanedResponse->toArray();
            $cleanedResponse = $cleanedResponse['result'];
        }

        catch (Exception $e) {
            Log::error($e);
            throw new Exception($e->getMessage());

        }

        return $cleanedResponse;

    }
}
