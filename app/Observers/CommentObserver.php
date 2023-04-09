<?php namespace App\Observers;

use App\Comment;
use App\Domain\CommentStatus;
use App\Events\CommentPublished;
use App\Mail\CommentConfirmMail;

class CommentObserver
{
    public function created(Comment $comment)
    {
        if ($comment->status->isPending()) {
            \Mail::to($comment->user)
                ->send(new CommentConfirmMail($comment));
        }

        event(new \App\Events\Stats\CommentAdded);
    }

    public function saving(Comment $comment)
    {
        if ($comment->isDirty('status')) {
            /** @var CommentStatus $was */
            $was = $comment->getOriginal('status');

            if ($was?->isPending() && $comment->status->isPublished()) {
                $comment->created_at = now();
            }
        }
    }

    public function saved(Comment $comment)
    {
        if ($comment->isDirty('status')) {
            if (in_array($comment->getOriginal('status'), [null, CommentStatus::Pending], true) &&
                $comment->status->isPublished()) {
                event(new CommentPublished($comment));
            }
        }
    }
}
