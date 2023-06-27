<?php

namespace App\Services\YandexPdd;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

readonly class DnsRecordEditResponse
{
    public bool $successful;
    public string $domain;
    public DnsRecord $record;

    public function __construct(Response $response)
    {
        $this->domain = $response->json('domain');
        $this->record = DnsRecord::fromArray($response->json('record'));
        $this->successful = $response->json('success') === 'ok';
    }

    public static function fakeSuccess(string $domain, array $dnsRecord)
    {
        return [
            'https://pddimp.yandex.ru/api2/admin/dns/edit*' => Factory::response([
                'record' => $dnsRecord,
                'domain' => $domain,
                'success' => 'ok',
            ]),
        ];
    }
}
