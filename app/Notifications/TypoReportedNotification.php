<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class TypoReportedNotification extends Notification
{
    public function __construct(private string $selection, private string $page) {}

    public function toTelegram(): string
    {
        $page = $this->page;
        $selection = htmlspecialchars_decode($this->selection, ENT_QUOTES);

        return "📝️ Опечатка на странице\n{$page}\n\n{$selection}";
    }

    public function via(): array
    {
        return [TelegramAdminChannel::class];
    }
}
