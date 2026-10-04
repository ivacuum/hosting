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
}
