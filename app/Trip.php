<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Finder\Finder;

/**
 * Поездка
 *
 * @property integer $id
 * @property integer $city_id
 * @property integer $user_id
 * @property string  $title_ru
 * @property string  $title_en
 * @property string  $slug
 * @property \Carbon\Carbon $date_start
 * @property \Carbon\Carbon $date_end
 * @property integer $status
 * @property string  $meta_title_ru
 * @property string  $meta_title_en
 * @property string  $meta_description_ru
 * @property string  $meta_description_en
 * @property string  $meta_image
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\City    $city
 * @property \Illuminate\Support\Collection $comments
 * @property \App\Country $country
 *
 * @property-read string  $title
 * @property-read string  $meta_title
 * @property-read string  $meta_description
 */
class Trip extends Model
{
    const STATUS_INACTIVE = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_HIDDEN = 2;

    protected $guarded = ['created_at', 'updated_at', 'goto'];
    protected $dates = ['date_start', 'date_end'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'rel');
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'rel');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeForCity($query, $id = null)
    {
        if (is_null($id)) {
            return $query;
        }

        return $query->where('city_id', $id);
    }

    public function scopeForCountry($query, $id = null)
    {
        if (is_null($id)) {
            return $query;
        }

        return $query->whereHas('city.country', function ($query) use ($id) {
            $query->where('country_id', $id);
        });
    }

    public function scopeNext($query)
    {
        return $query->where('date_start', '>=', $this->date_start)
            ->where('status', self::STATUS_PUBLISHED)
            ->where('id', '<>', $this->id)
            ->orderBy('date_start')
            ->take(2);
    }

    public function scopePrevious($query, $next_trips = 2)
    {
        // Всего 4 места под ссылки помимо текущей поездки
        // prev prev current next next
        // При просмотре последней поездки будет
        // prev prev prev prev current
        $take = 4 - $next_trips;

        return $query->where('date_start', '<=', $this->date_start)
            ->where('status', self::STATUS_PUBLISHED)
            ->where('id', '<>', $this->id)
            ->orderBy('date_start', 'desc')
            ->take($take);
    }

    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    public function scopeVisible($query)
    {
        return $query->where('status', '!=', self::STATUS_HIDDEN);
    }

    // Attributes
    public function getMetaDescriptionAttribute()
    {
        return $this->{'meta_description_' . \App::getLocale()};
    }

    public function getMetaTitleAttribute()
    {
        return $this->{'meta_title_' . \App::getLocale()};
    }

    public function getPeriodAttribute()
    {
        if ($this->date_start->month === $this->date_end->month) {
            return $this->monthName($this->date_start->month);
        }

        return $this->monthName($this->date_start->month) . '–' . $this->monthName($this->date_end->month);
    }

    public function getTitleAttribute()
    {
        return $this->{'title_' . \App::getLocale()};
    }

    public function getUserIdAttribute()
    {
        return 1;
    }

    public function getYearAttribute()
    {
        return $this->date_start->year;
    }

    // Methods
    public function breadcrumb()
    {
        return "{$this->title} {$this->localizedDate()}";
    }

    public function cityTimeline()
    {
        return $this->where('city_id', $this->city_id)
            ->orderBy('date_start')
            ->get()
            ->groupBy('year');
    }

    public function localizedDate()
    {
        if (0 === $this->date_end->diffInDays($this->date_start)) {
            return trim($this->date_start->formatLocalized(trans('life.date.same_day')));
        }

        if ($this->date_start->month !== $this->date_end->month) {
            return sprintf(trans('life.date.months'), $this->date_start->day, $this->date_start->formatLocalized('%B'), $this->date_end->day, $this->date_end->formatLocalized('%B'), $this->date_end->formatLocalized('%Y'));
        }

        return sprintf(trans('life.date.same_month'), $this->date_start->day, $this->date_end->day, $this->date_start->formatLocalized('%B'), $this->date_start->formatLocalized('%Y'));
    }

    public function metaDescription()
    {
        return $this->meta_description;
    }

    public function metaImage($width = null, $height = null)
    {
        if (!$this->meta_image) {
            return '';
        }

        if (starts_with($this->meta_image, 'http')) {
            return $this->meta_image;
        }

        if ($width && $height) {
            return \ViewHelper::picArbitrary($width, $height, $this->slug, $this->meta_image);
        }

        return \ViewHelper::pic($this->slug, $this->meta_image);
    }

    public function metaTitle()
    {
        return $this->meta_title ?: "{$this->title} &middot; {$this->localizedDate()}";
    }

    public function template()
    {
        return 'life.trips.'.str_replace('.', '_', $this->slug);
    }

    public function www()
    {
        return action('Life@page', $this->slug);
    }

    /**
     * @return \Symfony\Component\Finder\Finder|\Symfony\Component\Finder\SplFileInfo[]
     */
    public static function templatesIterator()
    {
        return Finder::create()
            ->files()
            ->in(base_path('resources/views/life/trips'))
            ->name('*.blade.php')
            ->notName('base.blade.php');
    }

    public static function idsByCity($id = null)
    {
        $ids = \Cache::rememberForever('published-trips-by-city', function () {
            $trips = self::published()->get(['id', 'city_id']);

            $result = [];

            foreach ($trips as $trip) {
                $result[$trip->city_id][] = $trip->id;
            }

            return $result;
        });

        if ($id && !empty($ids[$id])) {
            return $ids[$id];
        }

        return $ids;
    }

    public static function idsByCountry($id = null)
    {
        $ids = \Cache::rememberForever('published-trips-by-country', function () {
            $trips = self::published()
                ->with([
                    'city' => function ($query) {
                        $query->select(['id', 'country_id']);
                    }
                ])
                ->get(['id', 'city_id']);

            $result = [];

            foreach ($trips as $trip) {
                $result[$trip->city->country_id][] = $trip->id;
            }

            return $result;
        });

        if ($id && !empty($ids[$id])) {
            return $ids[$id];
        }

        return $ids;
    }

    protected function monthName($month)
    {
        // Собственный перевод, так как нужен именительный падеж в русском языке
        return trans("months.{$month}");
    }
}
