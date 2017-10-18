<?php namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Новости
 *
 * @property integer $id
 * @property integer $site_id
 * @property integer $user_id
 * @property string  $title
 * @property string  $html
 * @property integer $status
 * @property integer $views
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property \Illuminate\Support\Collection $comments
 * @property \App\User $user
 *
 * @mixin \Eloquent
 */
class News extends Model
{
    const STATUS_HIDDEN = 0;
    const STATUS_PUBLISHED = 1;

    protected $guarded = ['created_at', 'updated_at', 'goto'];

    // Relations
    public function comments()
    {
        return $this->morphMany(Comment::class, 'rel');
    }

    public function commentsPublished()
    {
        return $this->comments()->where('status', Comment::STATUS_PUBLISHED);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopePublished(Builder $query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
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

    public function www(): string
    {
        return path('News@show', $this->id);
    }

    // Static methods
    public static function interval(int $year, ?int $month = null, ?int $day = null): array
    {
        $start = Carbon::createFromDate($year, $month, $day);
        $end = $start->copy();

        if (!is_null($day)) {
            return [$start->startOfDay(), $end->endOfDay()];
        }

        if (!is_null($month)) {
            return [$start->startOfMonth(), $end->endOfMonth()];
        }

        return [$start->startOfYear(), $end->endOfYear()];
    }
}
