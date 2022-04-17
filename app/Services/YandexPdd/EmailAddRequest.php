<?php namespace App\Services\YandexPdd;

use App\Http\HttpPost;

class EmailAddRequest implements HttpPost
{
    public function __construct(private string $domain, private string $login, private string $password)
    {
    }

    public function endpoint(): string
    {
        return 'admin/email/add';
    }

    public function jsonSerialize()
    {
        return [
            'login' => $this->login,
            'domain' => $this->domain,
            'password' => $this->password,
        ];
    }
}
