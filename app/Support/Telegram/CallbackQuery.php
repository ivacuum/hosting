<?php namespace App\Support\Telegram;

readonly class CallbackQuery
{
    public function __construct(
        public int $id,
        public string $data,
        public User $from,
        public Message $message
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
