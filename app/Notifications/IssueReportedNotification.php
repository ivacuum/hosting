<?php

namespace App\Notifications;

use App\Domain\Telegram\Action\EscapeMarkdownCharactersAction;
use App\Domain\Telegram\Channel\TelegramAdminChannel;
use App\Models\Issue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class IssueReportedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private Issue $issue) {}

    public function toTelegram(): string
    {
        $escape = app(EscapeMarkdownCharactersAction::class);

        $id = $escape->execute($this->issue->id);
        $page = $escape->execute(url($this->issue->page));
        $text = $escape->execute(htmlspecialchars_decode($this->issue->text, ENT_QUOTES));
        $email = $escape->execute($this->issue->email);
        $title = $escape->execute($this->issue->title);

        return "💡 Обратная связь {$id} от {$email}\n{$title}\n{$page}\n\n{$text}";
    }

    public function via(): array
    {
        return [TelegramAdminChannel::class];
    }
}
