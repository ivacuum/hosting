<?php

namespace App;

use App\Domain\PhotoStatus;
use App\Domain\SocialMedia\Models\SocialMediaPost;
use App\Observers\PhotoObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @property int $id
 * @property int $user_id
 * @property int $rel_id
 * @property string $rel_type
 * @property string $slug
 * @property Spatial\Point $point
 * @property PhotoStatus $status
 * @property int $views
 * @property int $altitude
 * @property int $direction
 * @property int $speed
 * @property \Carbon\CarbonImmutable $taken_at
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property Trip $rel
 * @property SocialMediaPost $socialMediaPost
 * @property \Illuminate\Database\Eloquent\Collection<int, Tag> $tags
 * @property User $user
 *
 * @mixin \Eloquent
 */
#[ObservedBy(PhotoObserver::class)]
class Photo extends Model
{
    // Relations
    public function rel()
    {
        return $this->morphTo();
    }

    public function socialMediaPost()
    {
        return $this->hasOne(SocialMediaPost::class);
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
        return $this->point !== null;
    }

    public function isPublished(): bool
    {
        return $this->status === PhotoStatus::Published;
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
        return to('photos/{photo}', $this->id);
    }

    #[\Override]
    protected function casts(): array
    {
        return [
            'point' => Cast\PointCast::class,
            'views' => 'int',
            'rel_id' => 'int',
            'status' => PhotoStatus::class,
            'user_id' => 'int',
        ];
    }
}
