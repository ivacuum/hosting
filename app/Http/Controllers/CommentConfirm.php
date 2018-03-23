<?php namespace App\Http\Controllers;

use App\Comment;

class CommentConfirm extends Controller
{
    public function update(int $id)
    {
        $user = request()->user();

        /* @var Comment $comment */
        $comment = Comment::findOrFail($id);

        abort_unless($comment->user_id === $user->id, 404);

        if ($comment->status !== Comment::STATUS_PENDING) {
            return redirect($comment->rel->www())
                ->with('message', trans('comments.already_confirmed'));
        }

        $comment->status = Comment::STATUS_PUBLISHED;
        $comment->save();

        return redirect($comment->rel->www($comment->anchor()));
    }
}
