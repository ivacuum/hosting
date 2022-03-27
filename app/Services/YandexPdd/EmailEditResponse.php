<?php namespace App\Services\YandexPdd;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

class EmailEditResponse
{
    public $json;
    public bool $successful;

    public function __construct(Response $response)
    {
        $this->json = $response->json();
        $this->successful = $response->json('success') === 'ok';
    }

    public static function fakeSuccess(string $domain, string $email)
    {
        return [
            'https://pddimp.yandex.ru/api2/admin/email/edit*' => Factory::response([
                'domain' => $domain,
                'login' => $email,
                'uid' => 1,
                'success' => 'ok',
                'account' => [
                    'aliases' => [],
                    'enabled' => 'yes',
                    'hintq' => 'Секретный вопрос',
                    'uid' => 1,
                    'birth_date' => null,
                    'ready' => 'yes',
                    'login' => $email,
                    'sex' => null,
                    'fio' => 'Фамилия Имя',
                    'fname' => 'Имя',
                    'maillist' => 'no',
                    'iname' => 'Фамилия',
                ],
            ]),
        ];
    }
}
