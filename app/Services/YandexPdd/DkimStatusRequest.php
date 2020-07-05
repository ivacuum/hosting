<?php namespace App\Services\YandexPdd;

class DkimStatusRequest implements RequestInterface
{
    private bool $askSecretKey;
    private string $domain;

    public function __construct(string $domain, bool $askSecretKey)
    {
        $this->domain = $domain;
        $this->askSecretKey = $askSecretKey;
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
