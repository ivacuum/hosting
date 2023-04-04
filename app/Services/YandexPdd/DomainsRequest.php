<?php namespace App\Services\YandexPdd;

use App\Http\HttpRequest;

class DomainsRequest implements HttpRequest
{
    public function __construct(private int $page = 1)
    {
    }

    public function endpoint(): string
    {
        return 'admin/domain/domains';
    }

    public function jsonSerialize(): array
    {
        return [
            'page' => $this->page,
            'on_page' => 20,
        ];
    }
}
