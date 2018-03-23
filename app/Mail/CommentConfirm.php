<?php namespace App\Mail;

use App\Comment;
use Illuminate\Mail\Mailable;

class CommentConfirm extends Mailable
{
    public $email;
    public $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;

        $this->email = $this->email();
    }

    public function build()
    {
        return $this->subject(trans('comments.pending_title'))
            ->markdown('emails.comment-confirm');
    }

    public function email()
    {
        return $this->comment->emails()->create([
            'to' => $this->comment->user->email,
            'user_id' => $this->comment->user->id,
            'template' => class_basename(static::class),
        ]);
    }
}
