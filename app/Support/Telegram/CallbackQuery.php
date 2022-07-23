<?php namespace App\Support\Telegram;

class CallbackQuery
{
    public function __construct(
        public readonly int $id,
        public readonly string $data,
        public readonly User $from,
        public readonly Message $message
    ) {
    }

    public static function fromArray(array $payload)
    {
        return new self(
            $payload['id'],
            $payload['data'],
            User::fromArray($payload['from']),
            Message::fromArray($payload['message']),
        );
    }
}
