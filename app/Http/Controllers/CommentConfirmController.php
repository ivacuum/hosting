<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Domain\CommentStatus;
use App\Domain\SessionKey;
use Illuminate\Routing\Attributes\Controllers\Authorize;

class CommentConfirmController
{
    #[Authorize('confirm', 'comment')]
    public function __invoke(Comment $comment)
    {
        if (!$comment->status->isPending()) {
            return redirect($comment->rel->www())
                ->with(SessionKey::FlashMessage->value, __('Комментарий уже активирован.'));
        }

        $comment->status = CommentStatus::Published;
        $comment->save();

        return redirect($comment->rel->www($comment->anchor()));
    }
}
