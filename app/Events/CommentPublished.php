<?php

namespace App\Events;

use App\Models\Comment;

class CommentPublished
{
    public function __construct(public Comment $comment) {}
}
