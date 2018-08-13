<?php namespace App\Notifications;

use App\Comment;
use App\Issue as Model;
use App\Mail\IssueCommented as Mailable;

class IssueCommented extends ModelMailNotification
{
    public $comment;

    public function __construct(Model $model, Comment $comment)
    {
        $this->model = $model;
        $this->comment = $comment;
    }

    public function toMail($notifiable)
    {
        return (new Mailable($this->model, $this->comment, $notifiable))
            ->to($notifiable->email);
    }
}
