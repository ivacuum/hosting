<?php namespace App\Http\Controllers;

use App\Comment;
use App\Domain\CommentStatus;

class CommentConfirm
{
    public function __invoke(Comment $comment)
    {
        if (!$comment->status->isPending()) {
            return redirect($comment->rel->www())
                ->with('message', __('Комментарий уже активирован.'));
        }

        $comment->status = CommentStatus::Published;
        $comment->save();

        return redirect($comment->rel->www($comment->anchor()));
    }
}
