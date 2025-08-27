<?php

namespace App\Domain\Telegram\Api;

use App\Http\HttpRequest;

readonly class SendLocationRequest implements HttpRequest
{
    public function __construct(
        private int $chatId,
        private string $lat,
        private string $lon,
        private InlineKeyboardMarkup|null $replyMarkup = null,
        private int|null $replyToMessageId = null,
    ) {}

    public function endpoint(): string
    {
        return 'sendLocation';
    }

    public function jsonSerialize(): array
    {
        return [
            'chat_id' => $this->chatId,
            'latitude' => $this->lat,
            'longitude' => $this->lon,
            'reply_markup' => $this->replyMarkup,
            'reply_to_message_id' => $this->replyToMessageId,
        ];
    }
}
