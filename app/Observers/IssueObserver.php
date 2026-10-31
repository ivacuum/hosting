<?php

namespace App\Observers;

use App\Events\Stats;
use App\Models\Issue;

class IssueObserver
{
    public function created(Issue $issue): void
    {
        event(new Stats\IssueAdded);
    }
}
