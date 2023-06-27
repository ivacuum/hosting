<?php

namespace App\Services\YandexPdd;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

class EmailsResponse
{
    public $json;
    public int $total;
    public bool $successful;

    /** @var \Illuminate\Support\Collection|Account[] */
    public $accounts;

    public function __construct(Response $response)
    {
        $this->json = $response->json();
        $this->total = $response->json('total');
        $this->accounts = $response->collect('accounts')
            ->sortBy('login')
            ->map(fn ($payload) => Account::fromArray($payload));

        $this->successful = $response->json('success') === 'ok';
    }

    public static function fakeSuccess(string $domain, string $email)
    {
        return [
            'https://pddimp.yandex.ru/api2/admin/email/list*' => Factory::response([
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
            ]),
        ];
    }
}
