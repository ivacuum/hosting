<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function confirm(User $me, Comment $comment): bool
    {
        return $me->id === $comment->user_id;
    }

    public function delete(User $me): bool
    {
        return $me->isRoot();
    }

    public function update(User $me): bool
    {
        return $me->isRoot();
    }

    public function view(User $me): bool
    {
        return $me->isRoot();
    }

    public function viewAny(User $me): bool
    {
        return $me->isRoot();
    }
}
