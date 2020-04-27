<?php namespace App\Http\Controllers\Acp;

use App\Comment;
use App\Issue;
use App\Notifications\IssueCommentedNotification;
use Ivacuum\Generic\Controllers\Acp\Controller;

class IssueCommentController extends Controller
{
    public function __invoke(Issue $issue)
    {
        if (!$issue->canBeCommented()) {
            return back()->withErrors(['text' => 'Это обращение нельзя комментировать']);
        }

        $text = request('text');

        /** @var Comment $comment */
        $comment = $issue->comments()->create([
            'html' => $text,
            'status' => Comment::STATUS_PUBLISHED,
            'user_id' => request()->user()->id,
        ]);

        \Notification::send($issue->user, new IssueCommentedNotification($issue, $comment));

        return back()->with(['message' => 'Сообщение отправлено']);
    }

    protected function getModelName(): string
    {
        return Issue::class;
    }
}
