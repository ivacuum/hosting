<?php

namespace App\Notifications;

use App\Issue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class IssueReportedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private Issue $issue)
    {
    }

    public function toTelegram(): string
    {
        return "💡 Обратная связь {$this->issue->id} от {$this->issue->email}\n{$this->issue->title}\n" . url($this->issue->page) . "\n\n" . htmlspecialchars_decode($this->issue->text, ENT_QUOTES);
    }

    public function via(): array
    {
        return [TelegramAdminChannel::class];
    }
}
