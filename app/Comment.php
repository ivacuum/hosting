<?php namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Ivacuum\Generic\Traits\OriginalWithCast;
use Ivacuum\Generic\Traits\RecordsActivity;

/**
 * Комментарий
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $rel_id
 * @property string  $rel_type
 * @property integer $status
 * @property string  $html
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property \App\News|\App\Torrent|\App\Trip $rel
 * @property \App\User $user
 *
 * @mixin \Eloquent
 */
class Comment extends Model
{
    use OriginalWithCast, RecordsActivity;

    const STATUS_HIDDEN = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_PENDING = 2;

    protected $guarded = ['rel_id', 'rel_type', 'created_at', 'updated_at', 'goto'];
    protected $perPage = 20;

    protected $casts = [
        'rel_id' => 'int',
        'status' => 'int',
        'user_id' => 'int',
    ];

    // Relations
    public function emails()
    {
        return $this->morphMany(Email::class, 'rel');
    }

    public function rel()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeByType(Builder $query, $type)
    {
        return $query->where('rel_type', $type);
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('status', Comment::STATUS_PUBLISHED);
    }

    // Methods
    public function anchor(): string
    {
        return "#comment-{$this->id}";
    }

    public function breadcrumb(): string
    {
        return "#{$this->id}";
    }

    public function fullDate(): string
    {
        $format = $this->created_at->year == date('Y')
            ? '%e&nbsp;%B, %H:%M'
            : '%e&nbsp;%B&nbsp;%Y, %H:%M';

        if ($this->created_at->isToday()) {
            return trans('torrents.today').", ".$this->created_at->formatLocalized($format);
        } elseif ($this->created_at->isYesterday()) {
            return trans('torrents.yesterday').", ".$this->created_at->formatLocalized($format);
        }

        return $this->created_at->formatLocalized($format);
    }

    public function usersForNotification($model)
    {
        return static::with('user')
            ->distinct()
            ->where('rel_id', $model->id)
            ->where('rel_type', class_basename($model))
            ->get(['user_id'])
            // Автор новости, заметки, раздачи
            ->push([
                'user' => $model->user,
                'user_id' => $model->user_id,
            ])
            // Но без повторений
            ->unique('user_id')
            ->pluck('user')
            // Фильтр удаленных пользователей
            ->filter(function ($value) {
                return null !== $value;
            });
    }

    public function www(): string
    {
        switch ($this->rel_type) {
            case 'News': return path('News@show', $this->rel_id).$this->anchor();
            case 'Torrent': return path('Torrents@show', $this->rel_id).$this->anchor();
            case 'Trip': return path('Trips@show', [$this->rel_id, 'anchor' => $this->anchor()]);
        }

        return '';
    }
}
