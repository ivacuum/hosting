<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Ivacuum\Generic\Traits\RecordsActivity;

/**
 * @property int $id
 * @property int $user_id
 * @property Domain\IssueStatus $status
 * @property string $name
 * @property string $email
 * @property string $title
 * @property string $text
 * @property string $page
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection|Comment[] $comments
 * @property User $user
 *
 * @property-read int $comments_count
 *
 * @mixin \Eloquent
 */
class Issue extends Model
{
    use RecordsActivity;

    protected $guarded = ['created_at', 'updated_at'];
    protected $perPage = 50;

    protected $casts = [
        'status' => Domain\IssueStatus::class,
        'user_id' => 'int',
    ];

    // Relations
    public function comments()
    {
        return $this->morphMany(Comment::class, 'rel');
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
        return $this->status === Domain\IssueStatus::Open;
    }

    public function canBeCommented(): bool
    {
        return $this->status === Domain\IssueStatus::Open;
    }

    public function canBeOpened(): bool
    {
        return $this->status === Domain\IssueStatus::Closed;
    }

    public function isClosed(): bool
    {
        return $this->status === Domain\IssueStatus::Closed;
    }

    public function isNotClosed(): bool
    {
        return !$this->isClosed();
    }
}
