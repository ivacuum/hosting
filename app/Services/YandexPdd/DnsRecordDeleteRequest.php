<?php namespace App\Services\YandexPdd;

use App\Http\HttpPost;

class DnsRecordDeleteRequest implements HttpPost
{
    public function __construct(private string $domain, private int $id)
    {
    }

    public function endpoint(): string
    {
        return 'admin/dns/del';
    }

    public function jsonSerialize()
    {
        return [
            'domain' => $this->domain,
            'record_id' => $this->id,
        ];
    }
}
