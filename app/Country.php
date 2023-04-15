<?php namespace App;

use App\Action\GetTripCountByCitiesAction;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title_ru
 * @property string $title_en
 * @property string $slug
 * @property string $emoji
 * @property int $views
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property \Illuminate\Database\Eloquent\Collection|City[] $cities
 * @property \Illuminate\Database\Eloquent\Collection|Trip[] $trips
 * @property-read int $cities_count
 * @property-read string $title
 * @property int $trips_count
 * @property int $trips_published_count
 *
 * @mixin \Eloquent
 */
class Country extends Model
{
    use Traits\HasLocalizedTitle;
    use Traits\HasTripsMetaDescription;

    protected $casts = [
        'views' => 'int',
    ];

    protected $attributes = [
        'emoji' => '',
    ];

    // Relations
    public function cities()
    {
        return $this->hasMany(City::class)
            ->orderBy(City::titleField());
    }

    public function trips()
    {
        return $this->hasManyThrough(Trip::class, City::class)
            ->orderBy('date_start');
    }

    // Methods
    public static function allWithCitiesAndTrips(int $userId = 0)
    {
        $tripCount = resolve(GetTripCountByCitiesAction::class)->execute($userId);

        $cities = \CityHelper::cachedById()
            ->filter(fn (City $city) => isset($tripCount[$city->id]))
            ->each(function (City $city) use (&$tripCount) {
                $city->trips_count = $tripCount[$city->id]['total'] ?? 0;
                $city->trips_published_count = $tripCount[$city->id]['published'] ?? 0;
            })
            ->sortBy(Trip::titleField());

        $countries = $cities->groupBy('country_id');

        return \CountryHelper::cachedById()
            ->filter(fn (self $country) => isset($countries[$country->id]))
            ->each(function (self $country) use ($countries) {
                $country->setRelation('cities', $countries[$country->id]);

                $country->trips_count = $country->cities->sum->trips_count;
                $country->trips_published_count = $country->cities->sum->trips_published_count;
            })
            ->sortBy(static::titleField());
    }

    public static function allWithPublishedTrips(int $userId = 0)
    {
        $tripCount = resolve(GetTripCountByCitiesAction::class)->execute($userId);

        $cities = \CityHelper::cachedById()
            ->filter(fn (City $city) => isset($tripCount[$city->id]['published']))
            ->each(function (City $city) use (&$tripCount) {
                $city->trips_count = $tripCount[$city->id]['published'] ?? 0;
            });

        $countries = $cities->groupBy('country_id');

        return \CountryHelper::cachedById()
            ->filter(fn (self $country) => isset($countries[$country->id]))
            ->each(function (self $country) use ($countries) {
                $country->trips_count = $countries[$country->id]->sum->trips_count;
            })
            ->sortBy(static::titleField());
    }

    public function breadcrumb(): string
    {
        return "{$this->emoji} {$this->title}";
    }

    public function flagUrl(): string
    {
        return ($code = FlagCode::fromSlug($this->slug))
            ? "https://ivacuum.org/i/flags/svg/{$code}.svg"
            : 'https://life.ivacuum.org/0.gif';
    }

    public function initial(): string
    {
        return mb_substr($this->title, 0, 1);
    }

    public function metaTitle(): string
    {
        return "{$this->emoji} {$this->title}";
    }

    public function www(): string
    {
        return to('life/countries/{slug}', $this->slug);
    }
}
