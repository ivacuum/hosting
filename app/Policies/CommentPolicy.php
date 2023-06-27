<?php

namespace App\Policies;

use App\Comment;
use App\User;

class CommentPolicy
{
    public function confirm(User $me, Comment $comment)
    {
        return $me->id === $comment->user_id;
    }

    public function delete(User $me)
    {
        return $me->isRoot();
    }

    public function update(User $me)
    {
        return $me->isRoot();
    }

    public function view(User $me)
    {
        return $me->isRoot();
    }

    public function viewAny(User $me)
    {
        return $me->isRoot();
    }
}
