<?php namespace App;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\CommonMarkConverter;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $markdown
 * @property string $html
 * @property string $locale
 * @property int $status
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
    const STATUS_HIDDEN = 0;
    const STATUS_PUBLISHED = 1;

    protected $guarded = ['created_at', 'updated_at', 'goto'];

    protected $casts = [
        'views' => 'int',
        'status' => 'int',
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
        return $query->where('status', static::STATUS_PUBLISHED);
    }

    // Attributes
    public function setMarkdownAttribute($value)
    {
        $this->attributes['markdown'] = $value;
        $this->attributes['html'] = (new CommonMarkConverter)->convertToHtml($value);
    }

    // Methods
    public function breadcrumb(): string
    {
        return $this->title;
    }

    public function isHidden(): bool
    {
        return $this->status === self::STATUS_HIDDEN;
    }

    public function isPublished(): bool
    {
        return $this->status === self::STATUS_PUBLISHED;
    }

    public function isRussian(): bool
    {
        return $this->locale === 'ru';
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
