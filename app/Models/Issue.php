<?php

namespace App\Models;

use App\Domain\CommentStatus;
use App\Domain\IssueStatus;
use App\Observers\IssueObserver;
use App\Policies\IssuePolicy;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
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
 * @property \Illuminate\Database\Eloquent\Collection<int, Comment> $comments
 * @property \Illuminate\Database\Eloquent\Collection<int, Comment> $commentsPublished
 * @property User $user
 * @property-read int $comments_count
 *
 * @mixin \Eloquent
 */
#[ObservedBy(IssueObserver::class)]
#[UsePolicy(IssuePolicy::class)]
class Issue extends Model
{
    use Notifiable;

    // Relations
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'rel');
    }

    public function commentsPublished(): MorphMany
    {
        return $this->comments()->where('status', CommentStatus::Published);
    }

    public function emails(): MorphMany
    {
        return $this->morphMany(Email::class, 'rel');
    }

    public function user(): BelongsTo
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

    #[\Override]
    protected function casts(): array
    {
        return [
            'status' => IssueStatus::class,
            'user_id' => 'int',
        ];
    }
}
