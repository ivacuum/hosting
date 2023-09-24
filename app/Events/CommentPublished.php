<?php

namespace App\Events;

use App\Comment;

/**
 * Комментарий опубликован
 *
 * @property \App\Comment $comment
 */
class CommentPublished extends Event
{
    public function __construct(public Comment $comment)
    {
    }
}
