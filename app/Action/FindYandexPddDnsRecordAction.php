<?php namespace App\Action;

use App\Services\YandexPdd\DnsRecord;
use App\Services\YandexPdd\YandexPddClient;

class FindYandexPddDnsRecordAction
{
    public function __construct(private YandexPddClient $yandexPdd)
    {
    }

    public function execute(string $token, string $domain, int $id): DnsRecord
    {
        return $this->yandexPdd
            ->token($token)
            ->dnsRecords($domain)
            ->records
            ->firstWhere('id', $id);
    }
}
