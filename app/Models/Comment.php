<?php

namespace App\Models;

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
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @property int $id
 * @property int $user_id
 * @property int $rel_id
 * @property string $rel_type
 * @property CommentStatus $status
 * @property string $html
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property Issue|Magnet|News|Trip|null $rel
 * @property User $user
 *
 * @mixin \Eloquent
 */
#[ObservedBy(CommentObserver::class)]
#[UsePolicy(CommentPolicy::class)]
class Comment extends Model
{
    // Relations
    public function emails(): MorphMany
    {
        return $this->morphMany(Email::class, 'rel');
    }

    public function rel(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
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
            ->pluck('user')
            // Автор новости, заметки, раздачи
            ->push($model->user)
            // Фильтр удаленных пользователей
            ->filter(static fn (User|null $user) => $user !== null)
            // Но без повторений
            ->unique('id');
    }

    public function www(): string
    {
        return match (Relation::getMorphedModel($this->rel_type)) {
            Magnet::class => to('magnets/{magnet}', $this->rel_id) . $this->anchor(),
            News::class => to('news/{id}', $this->rel_id) . $this->anchor(),
            Trip::class => to('trips/{trip}', [$this->rel_id, 'anchor' => $this->anchor()]),
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
