<?php namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @property int $id
 * @property int $user_id
 * @property int $rel_id
 * @property string $rel_type
 * @property string $slug
 * @property string $lat
 * @property string $lon
 * @property Cast\PointCast $point
 * @property Domain\PhotoStatus $status
 * @property int $views
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @property Trip $rel
 * @property \Illuminate\Database\Eloquent\Collection|Tag[] $tags
 * @property User $user
 *
 * @method static Builder applyFilter($filter)
 * @method static Builder forTag($id)
 * @method static Builder forTrip($id)
 * @method static Builder forTrips($ids)
 * @method static Builder onMap()
 * @method static Builder published()
 *
 * @mixin \Eloquent
 */
class Photo extends Model
{
    protected $guarded = ['rel_id', 'rel_type', 'created_at', 'updated_at', 'goto'];
    protected $perPage = 50;

    protected $casts = [
        'point' => Cast\PointCast::class,
        'views' => 'int',
        'rel_id' => 'int',
        'status' => Domain\PhotoStatus::class,
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
        return $query
            ->when($filter === 'no-geo', fn (Builder $query) => $query->where('lat', '')->where('lon', ''))
            ->when($filter === 'no-tags', fn (Builder $query) => $query->doesntHave('tags'));
    }

    public function scopeForTag(Builder $query, $id = null)
    {
        return $query->unless(null === $id, fn (Builder $query) => $query->whereRelation('tags', 'tag_id', $id));
    }

    public function scopeForTrip(Builder $query, $id = null)
    {
        $type = (new Trip)->getMorphClass();

        return $query->unless(
            null === $id,
            fn (Builder $query) => $query->where('rel_type', $type)->where('rel_id', $id));
    }

    public function scopeForTrips(Builder $query, array $ids = [])
    {
        $type = (new Trip)->getMorphClass();

        return $query->unless(
            empty($ids),
            fn (Builder $query) => $query->where('rel_type', $type)->whereIn('rel_id', $ids)
        );
    }

    public function scopeOnMap(Builder $query)
    {
        return $query->where('lat', '<>', '')
            ->where('lon', '<>', '');
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('status', Domain\PhotoStatus::Published);
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

    public function isGig(): bool
    {
        return $this->rel_type === (new Gig)->getMorphClass();
    }

    public function isOnMap(): bool
    {
        return $this->lat
            && $this->lon;
    }

    public function isPublished(): bool
    {
        return $this->status === Domain\PhotoStatus::Published;
    }

    public function mobileUrl(): string
    {
        return "https://life.ivacuum.org/-/1000x750/{$this->slug}";
    }

    public function newSlugPrefix(string $newPrefix): void
    {
        [, $filename] = explode('/', $this->slug);

        $this->slug = "{$newPrefix}/{$filename}";
    }

    public function originalUrl(): string
    {
        return $this->isGig()
            ? "https://life.ivacuum.org/gigs/{$this->slug}"
            : "https://life.ivacuum.org/{$this->slug}";
    }

    public function thumbnailUrl(): string
    {
        return $this->isGig()
            ? "https://life.ivacuum.org/-/500x375/gigs/{$this->slug}"
            : "https://life.ivacuum.org/-/500x375/{$this->slug}";
    }

    public function www(): string
    {
        return path([Http\Controllers\Photos::class, 'show'], $this->id);
    }
}
