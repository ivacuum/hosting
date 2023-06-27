<?php

namespace App\Exceptions;

use Ivacuum\Generic\Exceptions\LimitExceededException;

class IssueLimitExceededException extends LimitExceededException
{
    protected function message()
    {
        return __('limits.issue');
    }
}
