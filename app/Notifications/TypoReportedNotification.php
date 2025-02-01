<?php

namespace App\Notifications;

use App\Domain\Telegram\Action\EscapeMarkdownCharactersAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class TypoReportedNotification extends Notification implements ShouldQueue
{
    use Queueable;

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
