<?php namespace App\Support\Telegram;

class User
{
    public function __construct(
        public readonly int $id,
        public readonly string $firstName,
        public readonly string|null $lastName,
        public readonly string|null $username,
        public readonly string|null $language
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
