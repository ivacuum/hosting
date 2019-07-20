<?php namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Новости
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $html
 * @property string $locale
 * @property int $status
 * @property int $views
 * @property Carbon $created_at
 * @property Carbon $updated_at
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
        return $this->comments()->where('status', Comment::STATUS_PUBLISHED);
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
        $this->attributes['html'] = \Parsedown::instance()->text($value);
    }

    // Methods
    public function breadcrumb(): string
    {
        return $this->title;
    }

    public function www(?string $anchor = null): string
    {
        return path('News@show', $this->id).$anchor;
    }

    // Static methods
    public static function interval(int $year, ?int $month = null, ?int $day = null): array
    {
        $start = Carbon::createFromDate($year, $month, $day);
        $end = $start->copy();

        if (null !== $day) {
            return [$start->startOfDay(), $end->endOfDay()];
        }

        if (null !== $month) {
            return [$start->startOfMonth(), $end->endOfMonth()];
        }

        return [$start->startOfYear(), $end->endOfYear()];
    }
}
