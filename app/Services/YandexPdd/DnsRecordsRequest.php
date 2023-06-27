<?php

namespace App\Services\YandexPdd;

use App\Http\HttpRequest;

class DnsRecordsRequest implements HttpRequest
{
    public function __construct(private string $domain)
    {
    }

    public function endpoint(): string
    {
        return 'admin/dns/list';
    }

    public function jsonSerialize(): array
    {
        return [
            'domain' => $this->domain,
        ];
    }
}
