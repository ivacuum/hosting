<?php namespace App\Services\YandexPdd;

class DkimStatusRequest implements RequestInterface
{
    public function __construct(private string $domain, private bool $askSecretKey)
    {
    }

    public function endpoint(): string
    {
        return 'admin/dkim/status';
    }

    public function httpMethod(): string
    {
        return 'GET';
    }

    public function jsonSerialize()
    {
        return [
            'domain' => $this->domain,
            'secretkey' => $this->askSecretKey
                ? 'yes'
                : null,
        ];
    }
}
