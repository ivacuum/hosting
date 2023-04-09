<?php namespace App\Support\Telegram;

use Carbon\CarbonImmutable;

class Message
{
    public function __construct(
        public readonly int $id,
        public readonly User $from,
        public readonly CarbonImmutable $date,
        public readonly string|null $text
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
}
