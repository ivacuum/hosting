<?php

namespace App\Domain\Telegram\Api;

class TelegramApiFake
{
    public static function answerCallbackQuery(): array
    {
        return [
            'api.telegram.org/bot*/answerCallbackQuery' => TelegramResponse::fakeCallbackQueryAnswered(),
        ];
    }

    public static function answerCallbackQueryExpired(): array
    {
        return [
            'api.telegram.org/bot*/answerCallbackQuery' => TelegramResponse::fakeCallbackQueryExpired(),
        ];
    }

    public static function sendMessage(int $messageId = 123): array
    {
        return [
            'api.telegram.org/bot*/sendMessage' => TelegramResponse::fakeMessageSent($messageId),
        ];
    }

    public static function sendMessageBadMarkdown(): array
    {
        return [
            'api.telegram.org/bot*/sendMessage' => TelegramResponse::fakeBadMarkdown(),
        ];
    }

    public static function sendMessageBlockedByUser(): array
    {
        return [
            'api.telegram.org/bot*/sendMessage' => TelegramResponse::fakeBlockedByUser(),
        ];
    }

    public static function setWebhook(): array
    {
        return [
            'api.telegram.org/bot*/setWebhook' => TelegramResponse::fakeWebhookSet(),
        ];
    }
}
