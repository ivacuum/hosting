<?php namespace App\Exceptions;

use Ivacuum\Generic\Exceptions\LimitExceededException;

class CommentLimitExceededException extends LimitExceededException
{
    protected function message()
    {
        return trans('limits.comment');
    }
}
