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

    public $issue;
    public $comment;

    public function __construct(Issue $issue, Comment $comment)
    {
        $this->issue = $issue;
        $this->comment = $comment;
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
