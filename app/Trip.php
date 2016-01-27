<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Поездка
 *
 * @property integer $id
 * @property string  $title
 * @property string  $slug
 * @property string  $tpl
 * @property \Carbon\Carbon $date_start
 * @property \Carbon\Carbon $date_end
 * @property boolean $published
 * @property string  $meta_title
 * @property string  $meta_description
 * @property string  $meta_image
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\City    $city
 * @property \App\Country $country
 */
class Trip extends Model
{
    protected $months_names = [
        1 => 'январь',
        2 => 'февраль',
        3 => 'март',
        4 => 'апрель',
        5 => 'май',
        6 => 'июнь',
        7 => 'июль',
        8 => 'август',
        9 => 'сентябрь',
        10 => 'октябрь',
        11 => 'ноябрь',
        12 => 'декабрь',
    ];

    protected $fillable = ['title', 'slug', 'date_start', 'date_end'];
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

    public function getPeriodAttribute()
    {
        if ($this->date_start->month === $this->date_end->month) {
            return $this->getMonthName($this->date_start->month);
        }

        return $this->getMonthName($this->date_start->month) . '–' . $this->getMonthName($this->date_end->month);
    }

    public function getYearAttribute()
    {
        return $this->date_start->year;
    }

    public function getLocalizedDate()
    {
        if ($this->date_start->eq($this->date_end)) {
            return "{$this->date_start->day} {$this->date_start->formatLocalized('%B %Y')}";
        }

        if ($this->date_start->month !== $this->date_end->month) {
            return "{$this->date_start->day} {$this->date_start->formatLocalized('%B')} – {$this->date_end->day} {$this->date_end->formatLocalized('%B %Y')}";
        }

        return "{$this->date_start->day}–{$this->date_end->day} {$this->date_start->formatLocalized('%B %Y')}";
    }

    public function getMetaDescription()
    {
        return $this->meta_description ?: "Заметки о поездке.";
    }

    public function getMetaTitle()
    {
        return $this->meta_title ?: "{$this->title} &middot; {$this->getLocalizedDate()}";
    }

    protected function getMonthName($month)
    {
        return $this->months_names[$month];
    }
}
