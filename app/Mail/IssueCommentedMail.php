<?php namespace App\Mail;

use App\Comment;
use App\Issue;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class IssueCommentedMail extends Mailable implements ShouldQueue
{
    public $user;
    public $email;
    public $issue;
    public $comment;

    public function __construct(Issue $issue, Comment $comment, User $user)
    {
        $this->user = $user;
        $this->email = $this->email($issue, $user);
        $this->issue = $issue;
        $this->comment = $comment;
    }

    public function build()
    {
        return $this->subject(trans('mail.issue_commented', ['title' => $this->issue->title]))
            ->markdown('emails.issue-commented')
            ->with('locale', $this->locale);
    }

    public function email(Issue $issue, User $user)
    {
        return $issue->emails()->create([
            'to' => $user->email,
            'locale' => $user->locale,
            'user_id' => $user->id,
            'template' => class_basename(static::class),
        ]);
    }
}
