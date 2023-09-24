<?php

namespace App\Notifications;

use App\Issue;
use Illuminate\Notifications\Notification;

class IssueReportedNotification extends Notification
{
    public function __construct(private Issue $issue)
    {
    }

    public function toTelegram(): string
    {
        $id = $this->issue->id;
        $page = url($this->issue->page);
        $text = htmlspecialchars_decode($this->issue->text, ENT_QUOTES);
        $email = $this->issue->email;
        $title = $this->issue->title;

        return "💡 Обратная связь {$id} от {$email}\n{$title}\n{$page}\n\n{$text}";
    }

    public function via(): array
    {
        return [TelegramAdminChannel::class];
    }
}
