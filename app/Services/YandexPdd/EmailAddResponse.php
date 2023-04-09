<?php namespace App\Services\YandexPdd;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

readonly class EmailAddResponse
{
    public bool $successful;
    public string $uid;
    public string $login;
    public string $domain;

    public function __construct(Response $response)
    {
        $this->uid = $response->json('uid');
        $this->login = $response->json('login');
        $this->domain = $response->json('domain');
        $this->successful = $response->json('success') === 'ok';
    }

    public static function fakeError()
    {
        return [
            'https://pddimp.yandex.ru/api2/admin/email/add*' => Factory::response([
                'error' => 'badpasswd',
                'domain' => 'example.com',
                'success' => 'error',
            ]),
        ];
    }

    public static function fakeSuccess(string $domain, string $login)
    {
        return [
            'https://pddimp.yandex.ru/api2/admin/email/add*' => Factory::response([
                'uid' => 1,
                'login' => $login,
                'domain' => $domain,
                'success' => 'ok',
            ]),
        ];
    }
}
