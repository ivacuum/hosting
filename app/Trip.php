<?php namespace App;

use App;
use Illuminate\Database\Eloquent\Model;

/**
 * Поездка
 *
 * @property integer $id
 * @property integer $city_id
 * @property string  $title_ru
 * @property string  $title_en
 * @property string  $slug
 * @property string  $tpl
 * @property \Carbon\Carbon $date_start
 * @property \Carbon\Carbon $date_end
 * @property boolean $published
 * @property string  $meta_title_ru
 * @property string  $meta_title_en
 * @property string  $meta_description_ru
 * @property string  $meta_description_en
 * @property string  $meta_image
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\City    $city
 * @property \App\Country $country
 *
 * @property-read string  $title
 * @property-read string  $meta_title
 * @property-read string  $meta_description
 */
class Trip extends Model
{
    protected $fillable = [
        'city_id',
        'title_ru',
        'title_en',
        'slug',
        'tpl',
        'date_start',
        'date_end',
        'published',
        'meta_title_ru',
        'meta_title_en',
        'meta_description_ru',
        'meta_description_en',
        'meta_image',
    ];
    protected $dates = ['date_start', 'date_end'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function scopeNext($query)
    {
        return $query->where('date_start', '>=', $this->date_start)
            ->where('published', 1)
            ->where('id', '<>', $this->id)
            ->orderBy('date_start', 'asc')
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
            ->where('published', 1)
            ->where('id', '<>', $this->id)
            ->orderBy('date_start', 'desc')
            ->take($take);
    }

    public function getMetaDescriptionAttribute()
    {
        return $this->{'meta_description_' . App::getLocale()};
    }

    public function getMetaTitleAttribute()
    {
        return $this->{'meta_title_' . App::getLocale()};
    }

    public function getPeriodAttribute()
    {
        if ($this->date_start->month === $this->date_end->month) {
            return $this->getMonthName($this->date_start->month);
        }

        return $this->getMonthName($this->date_start->month) . '–' . $this->getMonthName($this->date_end->month);
    }

    public function getTitleAttribute()
    {
        return $this->{'title_' . App::getLocale()};
    }

    public function getYearAttribute()
    {
        return $this->date_start->year;
    }

    public function cityTimeline()
    {
        return $this->where('city_id', $this->city_id)
            ->orderBy('date_start', 'asc')
            ->get()
            ->groupBy('year');
    }

    public function getLocalizedDate()
    {
        if (0 === $this->date_end->diffInDays($this->date_start)) {
            return trim($this->date_start->formatLocalized(trans('life.date.same_day')));
        }

        if ($this->date_start->month !== $this->date_end->month) {
            return sprintf(trans('life.date.months'), $this->date_start->day, $this->date_start->formatLocalized('%B'), $this->date_end->day, $this->date_end->formatLocalized('%B'), $this->date_end->formatLocalized('%Y'));
        }

        return sprintf(trans('life.date.same_month'), $this->date_start->day, $this->date_end->day, $this->date_start->formatLocalized('%B'), $this->date_start->formatLocalized('%Y'));
    }

    public function getMetaDescription()
    {
        return $this->meta_description;
    }

    public function getMetaTitle()
    {
        return $this->meta_title ?: "{$this->title} &middot; {$this->getLocalizedDate()}";
    }

    protected function getMonthName($month)
    {
        // Собственный перевод, так как нужен именительный падеж в русском языке
        return trans("months.{$month}");
    }
}
