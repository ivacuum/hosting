<?php

namespace App\Listeners;

use App\Events\IssueReported;
use App\Notifications\IssueReportedNotification;

class NotifyAdminAboutIssue
{
    public function handle(IssueReported $event): void
    {
        $issue = $event->issue;

        $issue->notify(new IssueReportedNotification($issue));
    }
}
