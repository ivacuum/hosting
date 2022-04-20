<?php namespace App\Services\YandexPdd;

use App\Http\HttpPost;

class DnsRecordEditRequest implements HttpPost
{
    public function __construct(
        private string $domain,
        private int $id,
        DnsRecordType $type,
        private string $subdomain,
        private int $ttl,
        private ?string $content = null,
        private ?int $priority = null,
        private ?int $weight = null,
        private ?int $port = null,
        private ?string $target = null,
    ) {
        if ($type->canHaveIdnContent()) {
            $this->content = idn_to_ascii($this->content, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46);
        }
    }

    public function endpoint(): string
    {
        return 'admin/dns/edit';
    }

    public function jsonSerialize()
    {
        return collect([
            'ttl' => $this->ttl,
            'port' => $this->port,
            'domain' => $this->domain,
            'target' => $this->target,
            'weight' => $this->weight,
            'content' => $this->content,
            'priority' => $this->priority,
            'record_id' => $this->id,
            'subdomain' => $this->subdomain,
        ])
            ->reject(fn ($value) => $value === null)
            ->all();
    }
}
