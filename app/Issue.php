<?php

namespace App;

use App\Domain\CommentStatus;
use App\Domain\IssueStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property int $user_id
 * @property IssueStatus $status
 * @property string $name
 * @property string $email
 * @property string $title
 * @property string $text
 * @property string $page
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property \Illuminate\Database\Eloquent\Collection|Comment[] $comments
 * @property \Illuminate\Database\Eloquent\Collection|Comment[] $commentsPublished
 * @property User $user
 * @property-read int $comments_count
 *
 * @mixin \Eloquent
 */
class Issue extends Model
{
    use Notifiable;

    protected $perPage = 50;
    protected $casts = [
        'status' => IssueStatus::class,
        'user_id' => 'int',
    ];

    // Relations
    public function comments()
    {
        return $this->morphMany(Comment::class, 'rel');
    }

    public function commentsPublished()
    {
        return $this->comments()->where('status', CommentStatus::Published);
    }

    public function emails()
    {
        return $this->morphMany(Email::class, 'rel');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Methods
    public function breadcrumb(): string
    {
        return $this->title;
    }

    public function canBeClosed(): bool
    {
        return $this->status === IssueStatus::Open;
    }

    public function canBeCommented(): bool
    {
        return $this->status === IssueStatus::Open;
    }

    public function canBeOpened(): bool
    {
        return $this->status === IssueStatus::Closed;
    }
}
