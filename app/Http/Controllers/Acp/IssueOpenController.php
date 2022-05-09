<?php namespace App\Http\Controllers\Acp;

use App\Domain\IssueStatus;
use App\Issue;

class IssueOpenController
{
    public function __invoke(Issue $issue)
    {
        if (!$issue->canBeOpened()) {
            return back()->withErrors(['text' => 'Обращение не может быть открыто']);
        }

        $issue->status = IssueStatus::Open;
        $issue->save();

        return back();
    }
}
