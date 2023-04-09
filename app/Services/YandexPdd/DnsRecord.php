<?php namespace App\Services\YandexPdd;

class DnsRecord
{
    public function __construct(
        public readonly int $id,
        public readonly string $domain,
        public readonly string $subdomain,
        public readonly DnsRecordType $type,
        public readonly string $content,
        public readonly string $fqdn,
        public readonly int|null $priority,
        public readonly int $ttl,
        public readonly string|null $target,
        public readonly int|null $port,
        public readonly int|null $weight,
        public readonly int|null $retry,
        public readonly int|null $refresh,
        public readonly int|null $expire
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
