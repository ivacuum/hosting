<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Ivacuum\Generic\Traits\RecordsActivity;

/**
 * Обращение пользователя
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $status
 * @property string  $name
 * @property string  $email
 * @property string  $title
 * @property string  $text
 * @property string  $page
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property \App\User $user
 *
 * @mixin \Eloquent
 */
class Issue extends Model
{
    use RecordsActivity;

    const STATUS_PENDING = 0;
    const STATUS_OPEN = 1;
    const STATUS_CLOSED = 2;

    protected $guarded = ['created_at', 'updated_at'];
    protected $perPage = 50;

    protected $casts = [
        'status' => 'int',
        'user_id' => 'int',
    ];

    // Relations
    public function comments()
    {
        return $this->morphMany(Comment::class, 'rel');
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

    public function canBeClosed(): bool
    {
        return $this->status === static::STATUS_OPEN;
    }

    public function canBeCommented(): bool
    {
        return $this->status === static::STATUS_OPEN;
    }

    public function canBeOpened(): bool
    {
        return $this->status === static::STATUS_CLOSED;
    }
}
