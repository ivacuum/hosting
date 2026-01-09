<?php

namespace App\Services;

use App\Domain\Telegram\Job\SendTelegramMessageJob;

class Telegram
{
    public function notifyAdmin(string $text): void
    {
        $chatId = config('services.telegram.admin_id');

        if ($chatId === null) {
            return;
        }

        if (\App::isLocal()) {
            $text = "\xF0\x9F\x9A\xA7 local\n{$text}";
        }

        SendTelegramMessageJob::dispatch($chatId, $text, true);
    }

    public function notifyAdminProduction(string $text): void
    {
        if (!\App::isProduction()) {
            return;
        }

        $this->notifyAdmin($text);
    }
}
