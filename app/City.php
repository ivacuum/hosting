<?php namespace App;

use App\Http\Controllers\Life;
use App\Traits\HasLocalizedTitle;
use App\Traits\HasTripsMetaDescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Город
 *
 * @property int $id
 * @property int $country_id
 * @property string $title_ru
 * @property string $title_en
 * @property string $slug
 * @property string $iata
 * @property string $lat
 * @property string $lon
 * @property int $views
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property \App\Country $country
 * @property \App\Trip $trips
 *
 * @property-read string $title
 * @property int $trips_count
 * @property int $trips_published_count
 *
 * @mixin \Eloquent
 */
class City extends Model
{
    use HasLocalizedTitle,
        HasTripsMetaDescription;

    protected $guarded = ['created_at', 'updated_at'];
    protected $perPage = 50;

    protected $casts = [
        'views' => 'int',
        'country_id' => 'int',
    ];

    // Relations
    public function country()
    {
        return $this->belongsTo(Country::class);
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

    public static function forInputSelect(): Collection
    {
        $titleField = static::titleField();

        return static::orderBy($titleField)->get(['id', $titleField])->pluck($titleField, 'id');
    }

    public static function forInputSelectJs(): Collection
    {
        $titleField = static::titleField();

        return static::orderBy($titleField)
            ->get(['id', 'slug', $titleField])
            ->map(function (City $item) use ($titleField) {
                return [
                    'key' => $item->id,
                    'slug' => $item->slug,
                    'value' => $item->{$titleField},
                ];
            });
    }

    public function initial(): string
    {
        return mb_substr($this->title, 0, 1);
    }

    public function isOnMap(): bool
    {
        return $this->lat && $this->lon;
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
        return path([Life::class, 'page'], $this->slug);
    }
}
