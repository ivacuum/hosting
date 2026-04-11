<?php

namespace App\Listeners;

use App\Domain\RateLimit\Events\RateLimitExceeded;

class TelegramLimitExceeded extends TelegramNotifier
{
    public function handle(RateLimitExceeded $event)
    {
        $text = "\xE2\x9A\xA0\xEF\xB8\x8F Превышен лимит {$event->maxAttempts}, {$event->key}";

        $this->telegram->notifyAdmin($text);
    }
}
