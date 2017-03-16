<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Фотография
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $rel_id
 * @property string  $rel_type
 * @property string  $slug
 * @property string  $lat
 * @property string  $lon
 * @property integer $views
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\User $user
 */
class Photo extends Model
{
    protected $guarded = ['rel_id', 'rel_type', 'created_at', 'updated_at', 'goto'];
    protected $perPage = 50;

    public function rel()
    {
        return $this->morphTo();
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'rel', 'taggable')
            ->orderBy(Tag::titleField());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeForTrip($query, $trip_id = null)
    {
        if (is_null($trip_id)) {
            return $query;
        }

        return $query->where('rel_id', $trip_id)->where('rel_type', 'Trip');
    }

    public function breadcrumb()
    {
        return $this->slug;
    }

    public function originalUrl()
    {
        return "https://life.ivacuum.ru/{$this->slug}";
    }

    public function thumbnailUrl()
    {
        return "https://life.ivacuum.ru/-/400x300/{$this->slug}";
    }
}
