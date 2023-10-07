<?php

namespace App;

use App\Domain\CommentStatus;
use App\Domain\Locale;
use App\Domain\NewsStatus;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\CommonMarkConverter;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $markdown
 * @property string $html
 * @property Locale $locale
 * @property NewsStatus $status
 * @property int $views
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property \Illuminate\Support\Collection<int, Comment> $comments
 * @property \Illuminate\Support\Collection<int, Comment> $commentsPublished
 * @property \Illuminate\Support\Collection<int, Email> $emails
 * @property User $user
 *
 * @mixin \Eloquent
 */
class News extends Model
{
    protected $casts = [
        'views' => 'int',
        'locale' => Locale::class,
        'status' => NewsStatus::class,
        'user_id' => 'int',
    ];

    protected $attributes = [
        'status' => NewsStatus::Hidden,
        'markdown' => '',
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

    public function canBeCommented(): bool
    {
        return $this->status === NewsStatus::Published;
    }

    public function www(string $anchor = null): string
    {
        return path([Http\Controllers\NewsController::class, 'show'], $this->id) . $anchor;
    }

    // Static methods
    public static function interval(int $year, int $month = null, int $day = null): array
    {
        $start = CarbonImmutable::createFromDate($year, $month, $day);

        if ($day !== null) {
            return [$start->startOfDay(), $start->endOfDay()];
        }

        if ($month !== null) {
            return [$start->startOfMonth(), $start->endOfMonth()];
        }

        return [$start->startOfYear(), $start->endOfYear()];
    }

    protected function markdown(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => [
                'markdown' => $value,
                'html' => (new CommonMarkConverter)->convert($value)->getContent(),
            ],
        );
    }
}
