<?php

namespace App\Listeners;

use App\Events\TypoReceived;
use Ivacuum\Generic\Listeners\TelegramNotifier;

class TelegramTypo extends TelegramNotifier
{
    public function handle(TypoReceived $event)
    {
        $page = $event->page;
        $selection = $event->selection;

        $text = "📝️ Опечатка на странице\n{$page}\n\n" . htmlspecialchars_decode($selection, ENT_QUOTES);

        $this->telegram->notifyAdmin($text);
    }
}
