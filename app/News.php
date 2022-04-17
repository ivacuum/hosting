<?php namespace App;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\CommonMarkConverter;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $markdown
 * @property string $html
 * @property Domain\Locale $locale
 * @property Domain\NewsStatus $status
 * @property int $views
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @property \Illuminate\Support\Collection|Comment[] $comments
 * @property \Illuminate\Support\Collection|Comment[] $commentsPublished
 * @property \Illuminate\Support\Collection|Email[] $emails
 * @property User $user
 *
 * @mixin \Eloquent
 */
class News extends Model
{
    protected $guarded = ['created_at', 'updated_at', 'goto'];

    protected $casts = [
        'views' => 'int',
        'locale' => Domain\Locale::class,
        'status' => Domain\NewsStatus::class,
        'user_id' => 'int',
    ];

    // Relations
    public function comments()
    {
        return $this->morphMany(Comment::class, 'rel');
    }

    public function commentsPublished()
    {
        return $this->comments()->where('status', Domain\CommentStatus::Published);
    }

    public function emails()
    {
        return $this->morphMany(Email::class, 'rel');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopePublished(Builder $query)
    {
        return $query->where('status', Domain\NewsStatus::Published);
    }

    // Attributes
    public function markdown(): Attribute
    {
        return new Attribute(
            set: fn ($value) => [
                'markdown' => $value,
                'html' => (new CommonMarkConverter)->convert($value)->getContent(),
            ],
        );
    }

    // Methods
    public function breadcrumb(): string
    {
        return $this->title;
    }

    public function canBeCommented(): bool
    {
        return $this->status === Domain\NewsStatus::Published;
    }

    public function www(?string $anchor = null): string
    {
        return path([Http\Controllers\NewsController::class, 'show'], $this->id) . $anchor;
    }

    // Static methods
    public static function interval(int $year, ?int $month = null, ?int $day = null): array
    {
        $start = CarbonImmutable::createFromDate($year, $month, $day);

        if (null !== $day) {
            return [$start->startOfDay(), $start->endOfDay()];
        }

        if (null !== $month) {
            return [$start->startOfMonth(), $start->endOfMonth()];
        }

        return [$start->startOfYear(), $start->endOfYear()];
    }
}
