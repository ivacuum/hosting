<?php

namespace App\Notifications;

use App\Comment;
use App\Domain\Config;
use App\Issue;
use App\Mail\IssueCommentedMail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class IssueCommentedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Issue $issue, public Comment $comment) {}

    public function toMail(User $notifiable)
    {
        return new IssueCommentedMail($this->issue, $this->comment, $notifiable)
            ->to($notifiable)
            ->replyTo(Config::SupportEmail->get());
    }

    public function via()
    {
        return ['mail'];
    }
}
