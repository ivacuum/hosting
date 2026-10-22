<?php

namespace App\Observers;

use App\Events\Stats;
use App\Issue;

class IssueObserver
{
    public function created(Issue $issue): void
    {
        event(new Stats\IssueAdded);
    }
}
