<?php

namespace App\Mail;

use App\Comment;
use App\Issue;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class IssueCommentedMail extends Mailable implements ShouldQueue
{
    use RecordsEmail;

    public function __construct(public Issue $issue, public Comment $comment, User $user)
    {
        $this->email = $this->email($issue->emails(), $user);

        $this->issue = $issue->withoutRelations();
        $this->comment = $comment->withoutRelations();
    }

    public function build()
    {
        return $this->subject(__('mail.issue_commented', ['title' => $this->issue->title]))
            ->markdown('emails.issue-commented')
            ->with('locale', $this->locale);
    }
}
