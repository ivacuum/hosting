<?php namespace App\Mail;

use App\Comment as Model;
use Illuminate\Mail\Mailable;

class CommentConfirm extends Mailable
{
    public $email;
    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->email = $this->email();
    }

    public function build()
    {
        return $this->subject(trans('comments.pending_title'))
            ->markdown('emails.comment-confirm');
    }

    public function email()
    {
        return $this->model->emails()->create([
            'to' => $this->model->user->email,
            'user_id' => $this->model->user->id,
            'template' => class_basename(static::class),
        ]);
    }
}
