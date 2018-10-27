<?php namespace App\Policies;

use App\Comment;
use App\User;
use Ivacuum\Generic\Policies\WithoutCreate;

class CommentPolicy extends WithoutCreate
{
    public function confirm(User $me, Comment $comment)
    {
        return $me->id === $comment->user_id;
    }
}
