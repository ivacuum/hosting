<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Комментарий
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $rel_type
 * @property integer $rel_id
 * @property string  $html
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\User $user
 */
class Comment extends Model
{
    protected $guarded = ['rel_id', 'rel_type', 'created_at', 'updated_at', 'goto'];
    protected $perPage = 20;

    public function rel()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('rel_type', $type);
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
}
