<?php

namespace App\Domain\Telegram\Api;

readonly class AnswerCallbackQueryRequest extends TelegramRequest
{
    public function __construct(
        private string $callbackQueryId,
        private string|null $text = null,
    ) {}

    public function endpoint(): string
    {
        return 'answerCallbackQuery';
    }

    public function jsonSerialize(): array
    {
        return [
            'callback_query_id' => $this->callbackQueryId,
            'text' => $this->text,
        ];
    }
}
