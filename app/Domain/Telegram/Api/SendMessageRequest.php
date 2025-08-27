<?php

namespace App\Domain\Telegram\Api;

use App\Http\HttpRequest;

readonly class SendMessageRequest implements HttpRequest
{
    public function __construct(
        private int $chatId,
        private string $text,
        private bool|null $disableWebPagePreview = false,
        private ParseMode|null $parseMode = null,
        private InlineKeyboardMarkup|null $replyMarkup = null,
    ) {}

    public function endpoint(): string
    {
        return 'sendMessage';
    }

    public function jsonSerialize(): array
    {
        return [
            'text' => $this->text,
            'chat_id' => $this->chatId,
            'parse_mode' => $this->parseMode?->value,
            'reply_markup' => $this->replyMarkup,
            'disable_web_page_preview' => $this->disableWebPagePreview
                ? true
                : null,
        ];
    }
}
