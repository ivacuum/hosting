<?php namespace App\Notifications;

use App\Comment;
use App\Issue;
use App\Mail\IssueCommentedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class IssueCommentedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Issue $issue, public Comment $comment)
    {
    }

    public function via()
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new IssueCommentedMail($this->issue, $this->comment, $notifiable))
            ->to($notifiable)
            ->replyTo(config('email.support'));
    }
}
