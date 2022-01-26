<?php namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Ivacuum\Generic\Traits\RecordsActivity;

/**
 * @property int $id
 * @property int $user_id
 * @property int $rel_id
 * @property string $rel_type
 * @property Domain\CommentStatus $status
 * @property string $html
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @property News|Torrent|Trip $rel
 * @property User $user
 *
 * @mixin \Eloquent
 */
class Comment extends Model
{
    use RecordsActivity;

    protected $guarded = ['rel_id', 'rel_type', 'created_at', 'updated_at', 'goto'];
    protected $perPage = 20;

    protected $casts = [
        'rel_id' => 'int',
        'status' => Domain\CommentStatus::class,
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
        return $query->where('status', Domain\CommentStatus::Published);
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
        $format = $this->created_at->isSameYear()
            ? '%e&nbsp;%B, %H:%M'
            : '%e&nbsp;%B&nbsp;%Y, %H:%M';

        if ($this->created_at->isToday()) {
            return __('Сегодня') . ", " . $this->created_at->formatLocalized($format);
        } elseif ($this->created_at->isYesterday()) {
            return __('Вчера') . ", " . $this->created_at->formatLocalized($format);
        }

        return $this->created_at->calendar(formats: ['sameElse' => 'LLL']);
    }

    public function isNotPending(): bool
    {
        return !$this->isPending();
    }

    public function isPending(): bool
    {
        return $this->status->isPending();
    }

    public function usersForNotification($model)
    {
        return static::with('user')
            ->distinct()
            ->where('rel_type', class_basename($model))
            ->where('rel_id', $model->id)
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
            ->filter(fn ($value) => null !== $value);
    }

    public function www(): string
    {
        return match ($this->rel_type) {
            'News' => path([Http\Controllers\NewsController::class, 'show'], $this->rel_id) . $this->anchor(),
            'Torrent' => path([Http\Controllers\Torrents::class, 'show'], $this->rel_id) . $this->anchor(),
            'Trip' => path([Http\Controllers\Trips::class, 'show'], [$this->rel_id, 'anchor' => $this->anchor()]),
            default => '',
        };
    }
}
