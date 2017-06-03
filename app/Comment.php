<?php namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Комментарий
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $rel_id
 * @property string  $rel_type
 * @property integer $status
 * @property string  $html
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\User $user
 */
class Comment extends Model
{
    const STATUS_HIDDEN = 0;
    const STATUS_PUBLISHED = 1;

    protected $guarded = ['rel_id', 'rel_type', 'created_at', 'updated_at', 'goto'];
    protected $perPage = 20;

    // Relations
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

    // Methods
    public function breadcrumb()
    {
        return "#{$this->id}";
    }

    public function fullDate()
    {
        $format = $this->created_at->year == date('Y') ? '%e&nbsp;%B, %H:%M' : '%e&nbsp;%B&nbsp;%Y, %H:%M';

        if ($this->created_at->isToday()) {
            return trans('torrents.today').", ".$this->created_at->formatLocalized($format);
        } elseif ($this->created_at->isYesterday()) {
            return trans('torrents.yesterday').", ".$this->created_at->formatLocalized($format);
        }

        return $this->created_at->formatLocalized($format);
    }

    public function usersForNotification($model)
    {
        return self::with('user')
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
                return !is_null($value);
            });
    }
}
