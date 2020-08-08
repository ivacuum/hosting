<?php namespace App\Mail;

use App\Comment;
use App\Http\Controllers\CommentConfirm;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class CommentConfirmMail extends Mailable implements ShouldQueue
{
    use RecordsEmail;

    public Comment $comment;
    public string $confirmLink;

    public function __construct(Comment $comment)
    {
        $this->email = $this->email($comment->emails(), $comment->user);
        $this->comment = $comment;
        $this->confirmLink = $this->email->signedLink(
            path_locale(CommentConfirm::class, $comment, false, $comment->user->locale)
        );
    }

    public function build()
    {
        return $this->subject(__('Подтверждение публикации комментария'))
            ->markdown('emails.comment-confirm')
            ->with('locale', $this->locale);
    }
}
