<?php

namespace App\Events;

use App\Issue;
use Illuminate\Queue\SerializesModels;

class IssueCreated extends Event
{
    use SerializesModels;

    public function __construct(public Issue $model)
    {
    }
}
