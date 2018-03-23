<?php namespace App\Observers;

use App\Comment;
use App\Events\CommentPublished;
use App\Mail\CommentConfirm;

class CommentObserver
{
    public function created(Comment $comment)
    {
        if ($comment->status === Comment::STATUS_PENDING) {
            \Mail::to($comment->user->email)
                ->queue(new CommentConfirm($comment));
        }
    }

    public function saved(Comment $comment)
    {
        if ($comment->isDirty('status')) {
            if (in_array($comment->getOriginal('status'), [null, Comment::STATUS_PENDING], true) &&
                $comment->status === Comment::STATUS_PUBLISHED) {
                event(new CommentPublished($comment));
            }
        }
    }
}
