<?php namespace App\Factory;

use App\Services\YandexPdd\DnsRecordType;

class YandexPddDnsRecordFactory
{
    public static function a(
        int $id = 1,
        string $domain = 'example.com',
        string $content = '127.0.0.1',
        string $subdomain = '@',
        string $fqdn = null,
        int $ttl = 3600,
    ): array {
        return [
            'ttl' => $ttl,
            'fqdn' => $fqdn ?? $domain,
            'type' => DnsRecordType::A->value,
            'domain' => $domain,
            'content' => $content,
            'priority' => '',
            'record_id' => $id,
            'subdomain' => $subdomain,
        ];
    }

    public static function cname(
        int $id = 1,
        string $domain = 'example.com',
        string $content = 'www.example.com.',
        string $subdomain = '*',
        string $fqdn = null,
        int $ttl = 3600,
    ): array {
        return [
            'ttl' => $ttl,
            'fqdn' => $fqdn ?? "*.{$domain}",
            'type' => DnsRecordType::CNAME->value,
            'domain' => $domain,
            'content' => $content,
            'priority' => '',
            'record_id' => $id,
            'subdomain' => $subdomain,
        ];
    }

    public static function mx(
        int $id = 1,
        string $domain = 'example.com',
        string $content = 'mx.yandex.net.',
        string $subdomain = '@',
        string $fqdn = null,
        int $ttl = 3600,
        int $priority = 10
    ): array {
        return [
            'ttl' => $ttl,
            'fqdn' => $fqdn ?? $domain,
            'type' => DnsRecordType::MX->value,
            'domain' => $domain,
            'content' => $content,
            'priority' => $priority,
            'record_id' => $id,
            'subdomain' => $subdomain,
        ];
    }

    public static function srv(
        int $id = 1,
        string $domain = 'example.com',
        string $target = 'domain-xmpp.yandex.net.',
        string $subdomain = '_xmpp-client._tcp',
        string $fqdn = null,
        int $ttl = 3600,
        int $priority = 10,
        int $port = 5222,
        int $weight = 0,
    ): array {
        return [
            'ttl' => $ttl,
            'fqdn' => $fqdn ?? "_xmpp-client._tcp.{$domain}",
            'port' => $port,
            'type' => DnsRecordType::SRV->value,
            'domain' => $domain,
            'weight' => $weight,
            'target' => $target,
            'priority' => $priority,
            'record_id' => $id,
            'subdomain' => $subdomain,
        ];
    }

    public static function txt(
        int $id = 1,
        string $domain = 'example.com',
        string $content = 'v=spf1 redirect=example.com',
        string $subdomain = '@',
        string $fqdn = null,
        int $ttl = 3600,
    ): array {
        return [
            'ttl' => $ttl,
            'fqdn' => $fqdn ?? $domain,
            'type' => DnsRecordType::TXT->value,
            'domain' => $domain,
            'content' => $content,
            'priority' => '',
            'record_id' => $id,
            'subdomain' => $subdomain,
        ];
    }
}
