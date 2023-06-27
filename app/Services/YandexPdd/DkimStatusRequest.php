<?php

namespace App\Services\YandexPdd;

use App\Http\HttpRequest;

class DkimStatusRequest implements HttpRequest
{
    public function __construct(private string $domain, private bool $askSecretKey)
    {
    }

    public function endpoint(): string
    {
        return 'admin/dkim/status';
    }

    public function jsonSerialize(): array
    {
        return [
            'domain' => $this->domain,
            'secretkey' => $this->askSecretKey
                ? 'yes'
                : null,
        ];
    }
}
