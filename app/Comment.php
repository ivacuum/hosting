<?php namespace App;

use App\Action\FormatCommentDateAction;
use App\Domain\CommentStatus;
use App\Scope\CommentRelationScope;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $rel_id
 * @property string $rel_type
 * @property CommentStatus $status
 * @property string $html
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property Issue|Magnet|News|Trip $rel
 * @property User $user
 *
 * @mixin \Eloquent
 */
class Comment extends Model
{
    protected $perPage = 20;

    protected $casts = [
        'rel_id' => 'int',
        'status' => CommentStatus::class,
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
        return resolve(FormatCommentDateAction::class)
            ->execute($this->created_at);
    }

    public function usersForNotification(Issue|Magnet|News|Trip $model)
    {
        return static::with('user')
            ->distinct()
            ->tap(new CommentRelationScope($model))
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
            'Torrent' => path([Http\Controllers\MagnetsController::class, 'show'], $this->rel_id) . $this->anchor(),
            'Trip' => path([Http\Controllers\Trips::class, 'show'], [$this->rel_id, 'anchor' => $this->anchor()]),
            default => '',
        };
    }
}
