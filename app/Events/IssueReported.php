<?php

namespace App\Events;

use App\Models\Issue;

class IssueReported
{
    public function __construct(public Issue $issue) {}
}
