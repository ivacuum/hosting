<?php

namespace App\Domain\Telegram\Api;

use App\Http\HttpRequest;

readonly class EditMessageTextRequest implements HttpRequest
{
    public function __construct(
        private int $chatId,
        private int $messageId,
        private string $text,
        private bool|null $disableWebPagePreview = false,
        private InlineKeyboardMarkup|null $replyMarkup = null,
    ) {}

    public function endpoint(): string
    {
        return 'editMessageText';
    }

    public function jsonSerialize(): array
    {
        return [
            'text' => $this->text,
            'chat_id' => $this->chatId,
            'parse_mode' => null,
            'message_id' => $this->messageId,
            'reply_markup' => $this->replyMarkup,
            'disable_web_page_preview' => $this->disableWebPagePreview
                ? true
                : null,
        ];
    }
}
