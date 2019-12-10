<?php namespace App;

use App\Http\Controllers\Photos;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Фотография
 *
 * @property int $id
 * @property int $user_id
 * @property int $rel_id
 * @property string  $rel_type
 * @property string  $slug
 * @property string  $lat
 * @property string  $lon
 * @property int $status
 * @property int $views
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @property \App\Trip $rel
 * @property \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
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

    protected $casts = [
        'views' => 'int',
        'rel_id' => 'int',
        'status' => 'int',
        'user_id' => 'int',
    ];

    // Relations
    public function rel()
    {
        return $this->morphTo();
    }

    public function tags(): MorphToMany
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
        return $query->unless(null === $id, function (Builder $query) use ($id) {
            return $query->whereHas('tags', function (Builder $query) use ($id) {
                $query->where('tag_id', $id);
            });
        });
    }

    public function scopeForTrip(Builder $query, $id = null)
    {
        return $query->unless(null === $id, function (Builder $query) use ($id) {
            return $query->where('rel_id', $id)->where('rel_type', 'Trip');
        });
    }

    public function scopeForTrips(Builder $query, array $ids = [])
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
        return $query->where('status', static::STATUS_PUBLISHED);
    }

    // Methods
    public function breadcrumb(): string
    {
        return str_replace('/', ' / ', $this->slug);
    }

    public function deleteFiles()
    {
        return \Storage::disk('photos')->delete($this->slug);
    }

    public function filename(): string
    {
        return explode('/', $this->slug)[1];
    }

    public function folder(): string
    {
        return explode('/', $this->slug)[0];
    }

    public function isOnMap(): bool
    {
        return $this->lat && $this->lon;
    }

    public function mobileUrl(): string
    {
        return "https://life.ivacuum.org/-/1000x750/{$this->slug}";
    }

    public function newSlugPrefix(string $newPrefix): void
    {
        [$prefix, $filename] = explode('/', $this->slug);

        $this->slug = "{$newPrefix}/{$filename}";
    }

    public function originalUrl(): string
    {
        return "https://life.ivacuum.org/{$this->slug}";
    }

    public function thumbnailUrl(): string
    {
        return "https://life.ivacuum.org/-/500x375/{$this->slug}";
    }

    public function www(): string
    {
        return path([Photos::class, 'show'], $this->id);
    }
}
