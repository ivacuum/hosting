<?php namespace App\Services\YandexPdd;

use App\Http\HttpPost;

class DnsRecordAddRequest implements HttpPost
{
    public function __construct(
        private string $domain,
        private DnsRecordType $type,
        private string $subdomain,
        private int $ttl,
        private string|null $content = null,
        private int|null $priority = null,
        private int|null $weight = null,
        private int|null $port = null,
        private string|null $target = null,
    ) {
        if ($content === '@') {
            $this->content = $domain;
        }

        if ($type->canHaveIdnContent()) {
            $this->content = idn_to_ascii($this->content, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46);
        }
    }

    public function endpoint(): string
    {
        return 'admin/dns/add';
    }

    public function jsonSerialize(): array
    {
        return [
            'ttl' => $this->ttl,
            'port' => $this->port,
            'type' => $this->type->value,
            'domain' => $this->domain,
            'target' => $this->target,
            'weight' => $this->weight,
            'content' => $this->content,
            'priority' => $this->priority,
            'subdomain' => $this->subdomain,
        ];
    }
}
