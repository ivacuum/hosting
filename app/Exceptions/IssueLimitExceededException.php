<?php

namespace App\Exceptions;

class IssueLimitExceededException extends LimitExceededException
{
    #[\Override]
    protected function message()
    {
        return __('limits.issue');
    }
}
