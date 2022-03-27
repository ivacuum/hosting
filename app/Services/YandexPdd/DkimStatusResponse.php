<?php namespace App\Services\YandexPdd;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

class DkimStatusResponse
{
    public bool $successful;
    public string $secretKey;

    public function __construct(Response $response)
    {
        $this->secretKey = $response->json('dkim.secretkey');
        $this->successful = $response->json('success') === 'ok';
    }

    public static function fakeSuccess(string $domain)
    {
        return [
            'https://pddimp.yandex.ru/api2/admin/dkim/status*' => Factory::response([
                'dkim' => [
                    'enabled' => 'yes',
                    'txtrecord' => 'txt',
                    'nsready' => 'yes',
                    'mailready' => 'yes',
                    'secretkey' => '-----BEGIN RSA PRIVATE KEY-----',
                ],
                'domain' => $domain,
                'success' => 'ok',
            ]),
        ];
    }
}
