<?php

namespace App\Events;

use App\Issue;

class IssueReported
{
    public function __construct(public Issue $issue)
    {
    }
}
