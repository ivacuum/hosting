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

    // Attributes
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

    // Methods
    public function artistTimeline()
    {
        return $this->where('artist_id', $this->artist_id)
            ->orderBy('date')
            ->get()
            ->groupBy('date.year');
    }

    public function fullDate()
    {
        return $this->date->formatLocalized(trans('life.date.same_day'));
    }

    public function metaTitle()
    {
        return $this->meta_title ?: "{$this->title} &middot; {$this->fullDate()}";
    }

    public function shortDate()
    {
        return $this->date->formatLocalized(trans('life.date.gig_short'));
    }
}
