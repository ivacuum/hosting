<?php namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentConfirm as CommentConfirmRequest;

class CommentConfirm extends Controller
{
    public function update(Comment $comment, CommentConfirmRequest $request)
    {
        if ($comment->status !== Comment::STATUS_PENDING) {
            return redirect($comment->rel->www())
                ->with('message', trans('comments.already_confirmed'));
        }

        $comment->status = Comment::STATUS_PUBLISHED;
        $comment->save();

        return redirect($comment->rel->www($comment->anchor()));
    }
}
