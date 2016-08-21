<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Model;

/**
 * Концерт
 *
 * @property integer $id
 * @property integer $city_id
 * @property string  $title
 * @property string  $slug
 * @property string  $tpl
 * @property \Carbon\Carbon $date
 * @property string  $venue
 * @property string  $venue_ru
 * @property string  $venue_en
 * @property integer $status
 * @property string  $meta_title
 * @property string  $meta_title_ru
 * @property string  $meta_title_en
 * @property string  $meta_description
 * @property string  $meta_description_ru
 * @property string  $meta_description_en
 * @property string  $meta_image
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\City $city
 */
class Gig extends Model
{
    const STATUS_HIDDEN = 0;
    const STATUS_PUBLISHED = 1;

    protected $fillable = [
        'city_id',
        'title',
        'slug',
        'tpl',
        'date',
        'venue_ru',
        'venue_en',
        'status',
        'meta_title_ru',
        'meta_title_en',
        'meta_description_ru',
        'meta_description_en',
        'meta_image',
    ];

    protected $dates = ['date'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function scopeNext($query)
    {
        return $query->where('date', '>=', $this->date)
            ->where('status', self::STATUS_PUBLISHED)
            ->where('id', '<>', $this->id)
            ->orderBy('date', 'asc')
            ->take(2);
    }

    public function scopePrevious($query, $next_gigs = 2)
    {
        // Всего 4 места под ссылки помимо текущего концерта
        // prev prev current next next
        // При просмотре последнего концерта будет
        // prev prev prev prev current
        $take = 4 - $next_gigs;

        return $query->where('date', '<=', $this->date)
            ->where('status', self::STATUS_PUBLISHED)
            ->where('id', '<>', $this->id)
            ->orderBy('date', 'desc')
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

    public function getMetaTitle()
    {
        return $this->meta_title ?: "{$this->title} &middot; {$this->fullDate()}";
    }

    public function getVenueAttribute()
    {
        return $this->{'venue_' . App::getLocale()};
    }

    public function fullDate()
    {
        return $this->date->formatLocalized(trans('life.date.same_day'));
    }

    public function shortDate()
    {
        return $this->date->formatLocalized(trans('life.date.gig_short'));
    }
}
