<?php

namespace App\Services;

use App\Contracts\ApiResponseHandlerInterface;
use App\Contracts\HttpWrapperInterface;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class HttpWrapper implements HttpWrapperInterface
{
    protected string $baseUrl;
    protected string $signature;
    protected bool $verify;
    protected int $timeout;
    protected string $token;
    protected string $api_secret;


    const HASH_ALGO = 'sha256';
    const CIPHER_ALGO = 'aes-256-cbc';

    public function __construct(protected ApiResponseHandlerInterface $responseHandler)
    {

        $this->setBaseUrl(config('ar24.ar24_url'));
        $this->setToken(config('ar24.ar24_token'));
        $this->setSecret(config('ar24.ar24_key'));
        $this->setVerify(true);
        $this->setTimeout(config('ar24.request_time_out'));


    }

    public function setBaseUrl(string $baseUrl): void
    {
        $this->baseUrl = $baseUrl;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function setSecret(string $api_secret): void
    {
        $this->api_secret = $api_secret;
    }

    public function setVerify(bool $verify): void
    {
        $this->verify = $verify;
    }

    public function setTimeout(int $timeout): void
    {
        $this->timeout = $timeout;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getVerify(): bool
    {
        return $this->verify;
    }

    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * @param string $endpoint
     * @param object $request
     * @param array $headers
     * @return string
     * @throws GuzzleException
     */

    public function get(string $endpoint, object $request, array $headers): string
    {
        $params = $this->prepareQuery($request);

        $client = new Client();
        $signature = $this->makeSignature($request->date);

        $options = [
            'headers' => ['signature' => $signature] + $headers,
            'timeout' => $this->timeout,
            'verify' => $this->verify,
        ];

        $response = $client->request('GET', $this->baseUrl . $endpoint, [
            'query' => $params,
            'headers' => $options['headers'],
            'timeout' => $options['timeout'],
            'verify' => $options['verify'],
        ]);
        $this->responseHandler->handleJsonResponse($response->getBody());

        return $this->decrypt($response->getBody(), $request->date);
    }


    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function post(string $endpoint, object $request, array $headers, bool $isMultipart = false): string
    {
        $client = new Client();
        $signature = $this->makeSignature($request->date);

        $options = [
            'headers' => ['signature' => $signature] + $headers,
            'timeout' => $this->timeout,
            'verify' => $this->verify,
        ];

        if ($isMultipart) {
            $response = $client->post($this->baseUrl . $endpoint, [
                'multipart' => $this->buildMultipartRequest($request),
                'headers' => [
                    'signature' => $signature
                ]

            ]);

            $this->responseHandler->handleJsonResponse($response->getBody());
        } else {
            $options['body'] = http_build_query($request);
            $options['headers']['Content-Type'] = 'application/x-www-form-urlencoded';
            $response = $client->post($this->baseUrl . $endpoint, $options);
        }
        return $this->decrypt($response->getBody(), $request->date);
    }


    private function buildMultipartRequest( $request): array
    {
        $multipart = [];

        foreach ($request as $key => $value) {
            if (is_array($value) && $key === 'attachment') {
                foreach ($value as $index => $attachmentValue) {
                    $multipart[] = [
                        'name' => 'attachment[' . $index . ']',
                        'contents' => $attachmentValue
                    ];
                }
            } elseif ($key === 'file') {
                $multipart[] = [
                    'name' => 'file',
                    'contents' => fopen($value, 'r')
                ];
            } else {
                $multipart[] = [
                    'name' => $key,
                    'contents' => $value
                ];
            }
        }

        return $multipart;
    }


    public function prepareQuery($request): array
    {
        $query = [];
        foreach ($request as $key => $value) {

            $query[$key] = $value;

        }
        return $query;
    }

    public static function makeSignature($date):string
    {
        $privateKey = config('ar24.ar24_key');
        $hashedPrivateKey = hash('sha256', $privateKey);
        $iv = mb_strcut(hash('sha256', $hashedPrivateKey), 0, 16, 'UTF-8');
        return openssl_encrypt($date, 'aes-256-cbc', $hashedPrivateKey, false, $iv);
    }

    public function decrypt($encryptedContent, $date): string
    {
        $key = hash(static::HASH_ALGO, $date . $this->api_secret);
        $iv = mb_strcut(hash(static::HASH_ALGO, $this->api_secret), 0, 16, 'UTF-8');

        $content = openssl_decrypt($encryptedContent, static::CIPHER_ALGO, $key, false, $iv);
        return $content !== false ? $content : '';
    }


}

