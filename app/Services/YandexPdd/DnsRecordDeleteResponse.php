<?php

namespace App\Services\YandexPdd;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

readonly class DnsRecordDeleteResponse
{
    public bool $successful;
    public string $domain;

    public function __construct(Response $response)
    {
        $this->domain = $response->json('domain');
        $this->successful = $response->json('success') === 'ok';
    }

    public static function fakeSuccess(string $domain)
    {
        return [
            'https://pddimp.yandex.ru/api2/admin/dns/del*' => Factory::response([
                'domain' => $domain,
                'success' => 'ok',
                'record_id' => 1,
            ]),
        ];
    }
}
