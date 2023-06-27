<?php

namespace App\Services\YandexPdd;

use App\Http\HttpRequest;

class EmailsRequest implements HttpRequest
{
    public function __construct(private string $domain, private int $page = 1)
    {
    }

    public function endpoint(): string
    {
        return 'admin/email/list';
    }

    public function jsonSerialize(): array
    {
        return [
            'page' => $this->page,
            'domain' => $this->domain,
            'on_page' => 30,
        ];
    }
}
