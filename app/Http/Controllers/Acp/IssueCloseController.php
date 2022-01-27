<?php namespace App\Http\Controllers\Acp;

use App\Domain\IssueStatus;
use App\Issue;

class IssueCloseController extends AbstractController
{
    public function __invoke(Issue $issue)
    {
        if (!$issue->canBeClosed()) {
            return back()->withErrors(['text' => 'Обращение не может быть закрыто']);
        }

        $issue->status = IssueStatus::Closed;
        $issue->save();

        return back();
    }

    protected function getModelName(): string
    {
        return Issue::class;
    }
}
