<?php namespace App;

use App\Traits\HasLocalizedTitle;
use App\Traits\HasTripsMetaDescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Страна
 *
 * @property integer $id
 * @property string  $title_ru
 * @property string  $title_en
 * @property string  $slug
 * @property string  $emoji
 * @property integer $views
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection|\App\City[] $cities
 * @property \Illuminate\Database\Eloquent\Collection|\App\Trip[] $trips
 *
 * @property-read string  $title
 *
 * @mixin \Eloquent
 */
class Country extends Model
{
    use HasLocalizedTitle,
        HasTripsMetaDescription;

    public $trips_count;
    public $cities_count;
    public $trips_published_count;

    protected $guarded = ['created_at', 'updated_at'];

    protected $casts = [
        'views' => 'int',
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
            ->orderBy('date_start', 'asc');
    }

    // Methods
    public static function allWithCitiesAndTrips(int $userId = 0)
    {
        $trips = Trip::tripsByCities($userId);

        $cities = \CityHelper::cachedById()
            ->filter(function (City $city) use (&$trips) {
                return isset($trips[$city->id]);
            })
            ->each(function (City $city) use (&$trips) {
                $city->trips_count = $trips[$city->id]['total'] ?? 0;
                $city->trips_published_count = $trips[$city->id]['published'] ?? 0;
            })
            ->sortBy(Trip::titleField());

        $countries = $cities->groupBy('country_id');

        return \CountryHelper::cachedById()
            ->filter(function (Country $country) use ($countries) {
                return isset($countries[$country->id]);
            })
            ->each(function (Country $country) use ($countries) {
                $country->setRelation('cities', $countries[$country->id]);

                $country->trips_count = $country->cities->sum->trips_count;
                $country->trips_published_count = $country->cities->sum->trips_published_count;
            })
            ->sortBy(static::titleField());
    }

    public static function allWithPublishedTrips(int $userId = 0)
    {
        $trips = Trip::tripsByCities($userId);

        $cities = \CityHelper::cachedById()
            ->filter(function (City $city) use (&$trips) {
                return isset($trips[$city->id]['published']);
            })
            ->each(function (City $city) use (&$trips) {
                $city->trips_count = $trips[$city->id]['published'] ?? 0;
            });

        $countries = $cities->groupBy('country_id');

        return \CountryHelper::cachedById()
            ->filter(function (Country $country) use ($countries) {
                return isset($countries[$country->id]);
            })
            ->each(function (Country $country) use ($countries) {
                $country->trips_count = $countries[$country->id]->sum->trips_count;
            })
            ->sortBy(static::titleField());
    }

    public function breadcrumb(): string
    {
        return "{$this->emoji} {$this->title}";
    }

    public function flagCode(): string
    {
        switch ($this->slug) {
            case 'afghanistan': return 'af';
            case 'albania': return 'al';
            case 'andorra': return 'ad';
            case 'argentina': return 'ar';
            case 'armenia': return 'am';
            case 'australia': return 'au';
            case 'austria': return 'at';
            case 'azerbaijan': return 'az';
            case 'belarus': return 'by';
            case 'belgium': return 'be';
            case 'brazil': return 'br';
            case 'bulgaria': return 'bg';
            case 'cambodia': return 'kh';
            case 'canada': return 'ca';
            case 'chile': return 'cl';
            case 'china': return 'cn';
            case 'colombia': return 'co';
            case 'croatia': return 'hr';
            case 'cuba': return 'cu';
            case 'cyprus': return 'cy';
            case 'czech-republic': return 'cz';
            case 'czechia': return 'cz';
            case 'denmark': return 'dk';
            case 'ecuador': return 'ec';
            case 'egypt': return 'eg';
            case 'estonia': return 'ee';
            case 'finland': return 'fi';
            case 'france': return 'fr';
            case 'georgia': return 'ge';
            case 'germany': return 'de';
            case 'greece': return 'gr';
            case 'greenland': return 'gl';
            case 'hungary': return 'hu';
            case 'iceland': return 'is';
            case 'india': return 'in';
            case 'indonesia': return 'id';
            case 'iran': return 'ir';
            case 'iraq': return 'iq';
            case 'ireland': return 'ie';
            case 'israel': return 'il';
            case 'italy': return 'it';
            case 'jamaica': return 'jm';
            case 'japan': return 'jp';
            case 'jordan': return 'jo';
            case 'kazakhstan': return 'kz';
            case 'latvia': return 'lv';
            case 'liechtenstein': return 'li';
            case 'lithuania': return 'lt';
            case 'luxembourg': return 'lu';
            case 'macedonia': return 'mk';
            case 'magadascar': return 'mg';
            case 'malaysia': return 'my';
            case 'maldives': return 'mv';
            case 'malta': return 'mt';
            case 'mexico': return 'mx';
            case 'moldova': return 'md';
            case 'monaco': return 'mc';
            case 'mongolia': return 'mn';
            case 'montenegro': return 'me';
            case 'morocco': return 'ma';
            case 'nepal': return 'np';
            case 'netherlands': return 'nl';
            case 'new-zealand': return 'nz';
            case 'norway': return 'no';
            case 'oman': return 'om';
            case 'pakistan': return 'pk';
            case 'panama': return 'pa';
            case 'paraguay': return 'py';
            case 'peru': return 'pe';
            case 'philippines': return 'ph';
            case 'poland': return 'pl';
            case 'portugal': return 'pt';
            case 'qatar': return 'qa';
            case 'romania': return 'ro';
            case 'russia': return 'ru';
            case 'seychelles': return 'sc';
            case 'singapore': return 'sg';
            case 'slovakia': return 'sk';
            case 'slovenia': return 'si';
            case 'south-africa': return 'za';
            case 'south-korea': return 'kr';
            case 'spain': return 'es';
            case 'sri-lanka': return 'lk';
            case 'sudan': return 'sd';
            case 'sweden': return 'se';
            case 'switzerland': return 'ch';
            case 'taiwan': return 'tw';
            case 'tajikistan': return 'tj';
            case 'thailand': return 'th';
            case 'tunisia': return 'tn';
            case 'turkey': return 'tr';
            case 'uae': return 'ae';
            case 'ukraine': return 'ua';
            case 'united-kingdom': return 'gb';
            case 'usa': return 'us';
            case 'uzbekistan': return 'uz';
            case 'venezuela': return 've';
            case 'vietnam': return 'vn';
            case 'yemen': return 'ye';
            case 'zambia': return 'zm';
            case 'zimbabwe': return 'zw';
        }

        return '';
    }

    public function flagUrl(): string
    {
        return ($code = $this->flagCode())
            ? "https://ivacuum.org/i/flags/svg/{$code}.svg"
            : "https://life.ivacuum.org/0.gif";
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
            ->get(['id', $titleField])
            ->map(function (Country $item) use ($titleField) {
                return [
                    'key' => $item->id,
                    'value' => $item->{$titleField},
                ];
            });
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
        return path('Life@country', $this->slug);
    }
}
