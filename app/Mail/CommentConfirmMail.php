<?php

namespace App\Mail;

use App\Http\Controllers\CommentConfirmController;
use App\Models\Comment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class CommentConfirmMail extends Mailable implements ShouldQueue
{
    use RecordsEmail;

    public string $confirmLink;

    public function __construct(public Comment $comment)
    {
        $this->email = $this->email($comment->emails(), $comment->user);
        $this->confirmLink = $this->email->signedLink(
            path_locale(CommentConfirmController::class, $comment, false, $comment->user->locale->value)
        );

        $this->comment = $comment->withoutRelations();
    }

    public function build()
    {
        return $this->subject(__('Подтверждение публикации комментария'))
            ->markdown('emails.comment-confirm');
    }
}
