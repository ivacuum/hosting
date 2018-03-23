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

    public $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
}
