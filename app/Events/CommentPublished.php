<?php namespace App\Events;

use App\Comment;
use Illuminate\Queue\SerializesModels;

/**
 * Комментарий опубликован
 *
 * @property \App\Comment $comment
 */
class CommentPublished extends Event
{
    use SerializesModels;

    public function __construct(public Comment $comment)
    {
    }
}
