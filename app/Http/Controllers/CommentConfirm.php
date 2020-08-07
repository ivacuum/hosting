<?php namespace App\Http\Controllers;

use App\Comment;

class CommentConfirm extends Controller
{
    public function update(Comment $comment)
    {
        if ($comment->status !== Comment::STATUS_PENDING) {
            return redirect($comment->rel->www())
                ->with('message', __('Комментарий уже активирован.'));
        }

        $comment->status = Comment::STATUS_PUBLISHED;
        $comment->save();

        return redirect($comment->rel->www($comment->anchor()));
    }
}
