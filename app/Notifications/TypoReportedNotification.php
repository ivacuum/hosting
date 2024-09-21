<?php

namespace App\Notifications;

use App\Domain\Telegram\Action\EscapeMarkdownCharactersAction;
use Illuminate\Notifications\Notification;

class TypoReportedNotification extends Notification
{
    public function __construct(private string $selection, private string $page) {}

    public function toTelegram(): string
    {
        $escape = app(EscapeMarkdownCharactersAction::class);

        $page = $escape->execute($this->page);
        $selection = $escape->execute(htmlspecialchars_decode($this->selection, ENT_QUOTES));

        return "📝️ Опечатка на странице\n{$page}\n\n{$selection}";
    }

    public function via(): array
    {
        return [TelegramAdminChannel::class];
    }
}
