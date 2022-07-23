<?php namespace App\Support\Telegram;

class User
{
    public function __construct(
        public readonly int $id,
        public readonly string $firstName,
        public readonly ?string $lastName,
        public readonly ?string $username,
        public readonly ?string $language
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
        return $this->id === (int) config('cfg.telegram.admin_id');
    }
}
