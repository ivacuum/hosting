<?php

namespace App\Services\YandexPdd;

use App\Factory\YandexPddDnsRecordFactory;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

class DnsRecordsResponse
{
    public readonly bool $successful;
    public readonly string $domain;

    /** @var \Illuminate\Support\Collection|DnsRecord[] */
    public $records;

    public function __construct(Response $response)
    {
        $this->domain = $response->json('domain');
        $this->records = $response->collect('records')
            ->sortBy([['type'], ['subdomain'], ['content']])
            ->map(fn ($payload) => DnsRecord::fromArray($payload));

        $this->successful = $response->json('success') === 'ok';
    }

    public static function fakeSuccess(string $domain)
    {
        return [
            'https://pddimp.yandex.ru/api2/admin/dns/list*' => Factory::response([
                'domain' => $domain,
                'records' => [
                    YandexPddDnsRecordFactory::a(domain: $domain),
                    YandexPddDnsRecordFactory::txt(id: 2, domain: $domain),
                    YandexPddDnsRecordFactory::cname(id: 3, domain: $domain, fqdn: "*.{$domain}"),
                    YandexPddDnsRecordFactory::mx(id: 4, domain: $domain),
                    YandexPddDnsRecordFactory::srv(id: 5, domain: $domain),
                ],
                'success' => 'ok',
            ]),
        ];
    }
}
