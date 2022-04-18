<?php namespace App\Services\YandexPdd;

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
                    [
                        'ttl' => 3600,
                        'fqdn' => $domain,
                        'type' => 'A',
                        'domain' => $domain,
                        'content' => '127.0.0.1',
                        'priority' => '',
                        'record_id' => 1,
                        'subdomain' => '@',
                    ],
                    [
                        'ttl' => 3600,
                        'fqdn' => $domain,
                        'type' => 'TXT',
                        'domain' => $domain,
                        'content' => 'v=spf1 redirect=example.com',
                        'priority' => '',
                        'record_id' => 2,
                        'subdomain' => '@',
                    ],
                    [
                        'ttl' => 3600,
                        'fqdn' => "*.{$domain}",
                        'type' => 'CNAME',
                        'domain' => $domain,
                        'content' => 'www.example.com.',
                        'priority' => '',
                        'record_id' => 3,
                        'subdomain' => '*',
                    ],
                    [
                        'ttl' => 3600,
                        'fqdn' => $domain,
                        'type' => 'MX',
                        'domain' => $domain,
                        'content' => 'mx.yandex.net.',
                        'priority' => 10,
                        'record_id' => 4,
                        'subdomain' => '@',
                    ],
                    [
                        'ttl' => 3600,
                        'fqdn' => "_xmpp-client._tcp.{$domain}",
                        'port' => 5222,
                        'type' => 'SRV',
                        'domain' => $domain,
                        'weight' => 0,
                        'target' => 'domain-xmpp.yandex.net.',
                        'priority' => 20,
                        'record_id' => 5,
                        'subdomain' => '_xmpp-client._tcp',
                    ],
                ],
                'success' => 'ok',
            ]),
        ];
    }
}
