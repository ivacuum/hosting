<?php

namespace App\Domain\Telegram\Action;

use App\Domain\Telegram\Job\SendTelegramMessageJob;

class NotifyAdminViaTelegramAction
{
    public function execute(string $text): void
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
}
