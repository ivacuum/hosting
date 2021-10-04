<?php namespace App\Services\YandexPdd;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

class DkimStatusResponse
{
    public string $secretKey;

    public function __construct(Response $response)
    {
        $this->secretKey = $response->json('dkim.secretkey');
    }

    public static function fakeSuccess(string $domain)
    {
        return Factory::response([
            'dkim' => [
                'enabled' => 'yes',
                'txtrecord' => 'txt',
                'nsready' => 'yes',
                'mailready' => 'yes',
                'secretkey' => '-----BEGIN RSA PRIVATE KEY-----',
            ],
            'domain' => $domain,
            'success' => 'ok',
        ]);
    }
}
