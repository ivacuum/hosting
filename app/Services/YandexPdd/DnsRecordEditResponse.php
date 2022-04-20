<?php namespace App\Services\YandexPdd;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

class DnsRecordEditResponse
{
    public readonly bool $successful;
    public readonly string $domain;
    public readonly DnsRecord $record;

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
