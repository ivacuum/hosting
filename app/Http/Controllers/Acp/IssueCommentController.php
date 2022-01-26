<?php namespace App\Http\Controllers\Acp;

use App\Comment;
use App\Domain\CommentStatus;
use App\Issue;
use App\Notifications\IssueCommentedNotification;

class IssueCommentController extends AbstractController
{
    public function __invoke(Issue $issue)
    {
        if (!$issue->canBeCommented()) {
            return back()->withErrors(['text' => 'Это обращение нельзя комментировать']);
        }

        $text = request('text');

        /** @var Comment $comment */
        $comment = $issue->comments()->make();
        $comment->html = $text;
        $comment->status = CommentStatus::Published;
        $comment->user_id = request()->user()->id;
        $comment->save();

        \Notification::send($issue->user, new IssueCommentedNotification($issue, $comment));

        return back()->with(['message' => 'Сообщение отправлено']);
    }

    protected function getModelName(): string
    {
        return Issue::class;
    }
}
