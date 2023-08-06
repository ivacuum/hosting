<?php

namespace App\Observers;

use App\Events\Stats;
use App\Issue;
use App\Notifications\IssueReportedNotification;

class IssueObserver
{
    public function created(Issue $issue)
    {
        event(new Stats\IssueAdded);

        $issue->notify(new IssueReportedNotification($issue));
    }
}
