<?php

namespace App\Domain\Life\Models;

use App\Cast;
use App\Domain\Life\Observer\CityObserver;
use App\Domain\Life\Policy\CityPolicy;
use App\Domain\Spatial;
use App\Traits;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $country_id
 * @property string $title_ru
 * @property string $title_en
 * @property string $slug
 * @property string $iata
 * @property string $hashtags
 * @property Spatial\Point $point
 * @property int $views
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property Country $country
 * @property Trip[] $trips
 * @property-read string $title
 * @property int $trips_count
 * @property int $trips_published_count
 *
 * @mixin \Eloquent
 */
#[ObservedBy(CityObserver::class)]
#[UsePolicy(CityPolicy::class)]
class City extends Model
{
    use Traits\HasLocalizedTitle;
    use Traits\HasTripsMetaDescription;

    protected $attributes = [
        'iata' => '',
    ];

    // Relations
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function gigs()
    {
        return $this->hasMany(Gig::class)
            ->orderBy('date');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class)
            ->orderBy('date_start');
    }

    // Methods
    public function breadcrumb(): string
    {
        return "{$this->country->emoji} {$this->title}";
    }

    public function initial(): string
    {
        return mb_substr($this->title, 0, 1);
    }

    public function isNotOnMap(): bool
    {
        return !$this->isOnMap();
    }

    public function isOnMap(): bool
    {
        return $this->point?->lat
            && $this->point?->lon;
    }

    public function loadCountry(): void
    {
        if (!$this->relationLoaded('country')) {
            $this->setRelation('country', \CountryHelper::findById($this->country_id));
        }
    }

    public function metaTitle(): string
    {
        return "{$this->country->emoji} {$this->title}, {$this->country->title}";
    }

    public function www(): string
    {
        return to('life/{slug}', $this->slug);
    }

    #[\Override]
    protected function casts(): array
    {
        return [
            'point' => Cast\PointCast::class,
            'views' => 'int',
            'country_id' => 'int',
        ];
    }
}
