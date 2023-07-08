<?php

namespace App\Support\Telegram;

use Carbon\CarbonImmutable;

readonly class Message
{
    public function __construct(
        public int $id,
        public User $from,
        public CarbonImmutable $date,
        public string|null $text
    ) {
    }

    public static function fromArray(array $payload)
    {
        return new self(
            $payload['message_id'],
            User::fromArray($payload['from']),
            CarbonImmutable::createFromTimestamp($payload['date']),
            $payload['text'] ?? null,
        );
    }

    public function isCommand(): bool
    {
        return str_starts_with($this->text, '/');
    }
}
