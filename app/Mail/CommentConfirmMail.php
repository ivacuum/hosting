<?php namespace App\Mail;

use App\Comment;
use App\Http\Controllers\CommentConfirm;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class CommentConfirmMail extends Mailable implements ShouldQueue
{
    public $email;
    public $comment;
    public $confirmLink;

    public function __construct(Comment $comment)
    {
        $this->email = $this->email($comment);
        $this->comment = $comment;
        $this->confirmLink = $this->email->signedLink(
            path_locale([CommentConfirm::class, 'update'], $comment, false, $comment->user->locale)
        );
    }

    public function build()
    {
        return $this->subject(trans('comments.pending_title'))
            ->markdown('emails.comment-confirm')
            ->with('locale', $this->locale);
    }

    public function email(Comment $comment)
    {
        return $comment->emails()->create([
            'to' => $comment->user->email,
            'locale' => $comment->user->locale,
            'user_id' => $comment->user->id,
            'template' => class_basename(static::class),
        ]);
    }
}
