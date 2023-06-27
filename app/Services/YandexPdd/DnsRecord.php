<?php

namespace App\Services\YandexPdd;

readonly class DnsRecord
{
    public function __construct(
        public int $id,
        public string $domain,
        public string $subdomain,
        public DnsRecordType $type,
        public string $content,
        public string $fqdn,
        public int|null $priority,
        public int $ttl,
        public string|null $target,
        public int|null $port,
        public int|null $weight,
        public int|null $retry,
        public int|null $refresh,
        public int|null $expire
    ) {
    }

    public static function fromArray(array $payload)
    {
        return new self(
            $payload['record_id'],
            $payload['domain'],
            $payload['subdomain'],
            DnsRecordType::from($payload['type']),
            $payload['content'] ?? $payload['target'],
            $payload['fqdn'],
            $payload['priority'] === ''
                ? null
                : $payload['priority'],
            $payload['ttl'],
            $payload['target'] ?? null,
            $payload['port'] ?? null,
            $payload['weight'] ?? null,
            $payload['retry'] ?? null,
            $payload['refresh'] ?? null,
            $payload['expire'] ?? null,
        );
    }
}
