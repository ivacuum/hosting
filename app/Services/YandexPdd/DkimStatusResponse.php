<?php namespace App\Services\YandexPdd;

use Psr\Http\Message\ResponseInterface;

class DkimStatusResponse
{
    private $json;
    private string $secretKey;

    public function __construct(ResponseInterface $response)
    {
        $this->json = $json = json_decode((string) $response->getBody());

        $this->secretKey = $json->dkim->secretkey;
    }

    public function getJson()
    {
        return $this->json;
    }

    public function getSecretKey()
    {
        return $this->secretKey;
    }
}
