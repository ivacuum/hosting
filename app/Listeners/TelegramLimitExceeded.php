<?php

namespace App\Listeners;

use App\Events\LimitExceeded;

class TelegramLimitExceeded extends TelegramNotifier
{
    public function handle(LimitExceeded $event)
    {
        $limit = config("cfg.limits.{$event->title}");

        $text = "\xE2\x9A\xA0\xEF\xB8\x8F Превышен лимит {$limit}, {$event->title}: {$event->value}";

        $this->telegram->notifyAdmin($text);
    }
}
