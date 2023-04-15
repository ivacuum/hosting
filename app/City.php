<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $country_id
 * @property string $title_ru
 * @property string $title_en
 * @property string $slug
 * @property string $iata
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
class City extends Model
{
    use Traits\HasLocalizedTitle;
    use Traits\HasTripsMetaDescription;

    protected $perPage = 50;

    protected $casts = [
        'point' => Cast\PointCast::class,
        'views' => 'int',
        'country_id' => 'int',
    ];

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
        return path([Http\Controllers\LifeController::class, 'page'], $this->slug);
    }

    public function wwwAcp(): string
    {
        return path([Http\Controllers\Acp\Cities::class, 'show'], $this);
    }

    public function wwwAcpPhotos(): string
    {
        return path([Http\Controllers\Acp\Photos::class, 'index'], [$this->getForeignKey() => $this]);
    }

    public function wwwAcpTrips(): string
    {
        return path([Http\Controllers\Acp\Trips::class, 'index'], [$this->getForeignKey() => $this]);
    }
}
