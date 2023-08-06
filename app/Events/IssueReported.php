<?php

namespace App\Events;

use App\Issue;
use Illuminate\Queue\SerializesModels;

class IssueReported
{
    use SerializesModels;

    public function __construct(public Issue $issue)
    {
    }
}
