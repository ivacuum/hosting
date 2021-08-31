<?php namespace App\Services\YandexPdd;

use Illuminate\Http\Client\Response;

class DkimStatusResponse
{
    public $json;
    public string $secretKey;

    public function __construct(Response $response)
    {
        $this->json = $json = $response->object();

        $this->secretKey = $json->dkim->secretkey;
    }
}
