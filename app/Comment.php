<?php

namespace App;

use App\Action\FormatCommentDateAction;
use App\Domain\CommentStatus;
use App\Domain\Life\Models\Trip;
use App\Domain\Magnet\Models\Magnet;
use App\Observers\CommentObserver;
use App\Policies\CommentPolicy;
use App\Scope\CommentRelationScope;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
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
#[ObservedBy(CommentObserver::class)]
#[UsePolicy(CommentPolicy::class)]
class Comment extends Model
{
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
        return static::query()
            ->with('user')
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
            ->filter(fn ($value) => $value !== null);
    }

    public function www(): string
    {
        return match ($this->rel_type) {
            (new Magnet)->getMorphClass() => to('magnets/{magnet}', $this->rel_id) . $this->anchor(),
            (new News)->getMorphClass() => to('news/{id}', $this->rel_id) . $this->anchor(),
            (new Trip)->getMorphClass() => to('trips/{trip}', [$this->rel_id, 'anchor' => $this->anchor()]),
            default => '',
        };
    }

    #[\Override]
    protected function casts(): array
    {
        return [
            'rel_id' => 'int',
            'status' => CommentStatus::class,
            'user_id' => 'int',
        ];
    }
}
