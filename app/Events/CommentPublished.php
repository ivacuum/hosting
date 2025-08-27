<?php

namespace App\Events;

use App\Comment;

class CommentPublished
{
    public function __construct(public Comment $comment) {}
}
