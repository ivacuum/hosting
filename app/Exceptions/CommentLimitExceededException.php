<?php

namespace App\Exceptions;

use Ivacuum\Generic\Exceptions\LimitExceededException;

class CommentLimitExceededException extends LimitExceededException
{
    #[\Override]
    protected function message()
    {
        return __('limits.comment');
    }
}
