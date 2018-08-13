<?php namespace App\Mail;

use App\Comment;
use App\Issue as Model;
use App\Traits\LocalizedMail;
use App\User;
use Illuminate\Mail\Mailable;

class IssueCommented extends Mailable
{
    use LocalizedMail;

    public $user;
    public $email;
    public $model;
    public $comment;

    public function __construct(Model $model, Comment $comment, User $user)
    {
        $this->user = $user;
        $this->model = $model;
        $this->comment = $comment;

        $this->email = $this->email();
        $this->setLocale($user->locale);
    }

    public function build()
    {
        return $this->subject(trans('mail.issue_commented', ['title' => $this->model->title]))
            ->markdown('emails.issue-commented');
    }

    public function email()
    {
        return $this->model->emails()->create([
            'to' => $this->user->email,
            'locale' => $this->user->locale,
            'user_id' => $this->user->id,
            'template' => class_basename(static::class),
        ]);
    }
}
