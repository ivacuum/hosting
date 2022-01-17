<?php namespace App\Services\YandexPdd;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

class EmailsResponse
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
        return Factory::response([
            'domain' => $domain,
            'pages' => 1,
            'total' => 1,
            'on_page' => 30,
            'box_limit' => 2147483647,
            'success' => 'ok',
            'found' => 1,
            'accounts' => [
                [
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
            ],
            'page' => 1,
        ]);
    }
}