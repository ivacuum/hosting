<?php

namespace App\Exceptions;

class CommentLimitExceededException extends LimitExceededException
{
    #[\Override]
    protected function message()
    {
        return __('limits.comment');
    }
}
