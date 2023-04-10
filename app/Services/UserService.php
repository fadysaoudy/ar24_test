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
        /**
         * This function sends a GET request to retrieve user data, using the provided UserGetRequest object
         * as the request parameters. The response is expected to be in JSON format, but may include additional
         * data that needs to be cleaned up. The function parses the response to extract the 'result' field,
         * which contains the relevant user data. The cleaned up response is returned as a stdClass object.
         */

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
