<?php namespace App\Mail;

use App\Comment;
use App\Email;
use App\Issue;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class IssueCommentedMail extends Mailable implements ShouldQueue
{
    use RecordsEmail;

    public $user;
    public $issue;
    public $comment;

    public function __construct(Issue $issue, Comment $comment, User $user)
    {
        $this->user = $user;
        $this->email = $this->email($issue->emails(), $user);
        $this->issue = $issue;
        $this->comment = $comment;
    }

    public function build()
    {
        return $this->subject(trans('mail.issue_commented', ['title' => $this->issue->title]))
            ->markdown('emails.issue-commented')
            ->with('locale', $this->locale);
    }
}
