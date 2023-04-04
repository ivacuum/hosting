<?php namespace App\Services\YandexPdd;

use App\Http\HttpPost;

class EmailEditRequest implements HttpPost
{
    public function __construct(
        private string $domain,
        private string $email,
        private string $password
    ) {
    }

    public function endpoint(): string
    {
        return 'admin/email/edit';
    }

    public function jsonSerialize(): array
    {
        return [
            'login' => $this->email,
            'domain' => $this->domain,
            'password' => $this->password,
        ];
    }
}
