<?php namespace App;

use Illuminate\Database\Eloquent\Builder;
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
 * @property integer $status
 * @property integer $views
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property \App\User $user
 *
 * @mixin \Eloquent
 */
class Photo extends Model
{
    const STATUS_HIDDEN = 0;
    const STATUS_PUBLISHED = 1;

    protected $guarded = ['rel_id', 'rel_type', 'created_at', 'updated_at', 'goto'];
    protected $perPage = 50;

    // Relations
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

    // Scopes
    public function scopeApplyFilter(Builder $query, $filter = null)
    {
        return $query->when($filter === 'no-geo', function (Builder $query) {
            return $query->where('lat', '')->where('lon', '');
        })->when($filter === 'no-tags', function (Builder $query) {
            return $query->doesntHave('tags');
        });
    }

    public function scopeForTag(Builder $query, $id = null)
    {
        return $query->unless(is_null($id), function (Builder $query) use ($id) {
            return $query->whereHas('tags', function (Builder $query) use ($id) {
                $query->where('tag_id', $id);
            });
        });
    }

    public function scopeForTrip(Builder $query, $id = null)
    {
        return $query->unless(is_null($id), function (Builder $query) use ($id) {
            return $query->where('rel_id', $id)->where('rel_type', 'Trip');
        });
    }

    public function scopeForTrips(Builder $query, $ids = [])
    {
        return $query->unless(empty($ids), function (Builder $query) use ($ids) {
            return $query->whereIn('rel_id', $ids)->where('rel_type', 'Trip');
        });
    }

    public function scopeOnMap(Builder $query)
    {
        return $query->where('lat', '<>', '')
            ->where('lon', '<>', '');
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    // Methods
    public function breadcrumb()
    {
        return str_replace('/', ' / ', $this->slug);
    }

    public function deleteFiles()
    {
        return \Storage::disk('photos')->delete($this->slug);
    }

    public function filename()
    {
        return explode('/', $this->slug)[1];
    }

    public function folder()
    {
        return explode('/', $this->slug)[0];
    }

    public function isOnMap()
    {
        return $this->lat && $this->lon;
    }

    public function newSlugPrefix($new_prefix)
    {
        list($prefix, $filename) = explode('/', $this->slug);

        $this->slug = "{$new_prefix}/{$filename}";
    }

    public function originalUrl()
    {
        return "https://life.ivacuum.ru/{$this->slug}";
    }

    public function thumbnailUrl()
    {
        return "https://life.ivacuum.ru/-/400x300/{$this->slug}";
    }

    public function www()
    {
        return path('Photos@show', $this->id);
    }
}
