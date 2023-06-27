<?php

namespace App\Support\Telegram;

readonly class User
{
    public function __construct(
        public int $id,
        public string $firstName,
        public string|null $lastName,
        public string|null $username,
        public string|null $language
    ) {
    }

    public static function fromArray(array $payload)
    {
        return new self(
            $payload['id'],
            $payload['first_name'],
            $payload['last_name'] ?? null,
            $payload['username'] ?? null,
            $payload['language_code'] ?? null,
        );
    }

    public function isAdmin(): bool
    {
        return $this->id === (int) config('services.telegram.admin_id');
    }
}
