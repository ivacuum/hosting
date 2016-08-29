<?php namespace App;

use App;
use Illuminate\Database\Eloquent\Model;

/**
 * Концерт
 *
 * @property integer $id
 * @property integer $city_id
 * @property integer $artist_id
 * @property string  $title_ru
 * @property string  $title_en
 * @property string  $slug
 * @property string  $tpl
 * @property \Carbon\Carbon $date
 * @property integer $status
 * @property string  $meta_title_ru
 * @property string  $meta_title_en
 * @property string  $meta_description_ru
 * @property string  $meta_description_en
 * @property string  $meta_image
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property-read \App\City $city
 *
 * @property-read string  $title
 * @property-read string  $meta_title
 * @property-read string  $meta_description
 */
class Gig extends Model
{
    const STATUS_HIDDEN = 0;
    const STATUS_PUBLISHED = 1;

    protected $guarded = ['created_at', 'updated_at'];
    protected $dates = ['date'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

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

    public function scopeTimeline($query)
    {
        return $query->where('artist_id', $this->artist_id)
            ->orderBy('date', 'asc');
    }

    public function getMetaDescriptionAttribute()
    {
        return $this->{'meta_description_' . App::getLocale()};
    }

    public function getMetaTitleAttribute()
    {
        return $this->{'meta_title_' . App::getLocale()};
    }

    public function getTitleAttribute()
    {
        return $this->{'title_' . App::getLocale()};
    }

    public function getMetaTitle()
    {
        return $this->meta_title ?: "{$this->title} &middot; {$this->fullDate()}";
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
