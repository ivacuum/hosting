<?php namespace App;

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
 *
 * @mixin \Eloquent
 */
class Gig extends Model
{
    const STATUS_HIDDEN = 0;
    const STATUS_PUBLISHED = 1;

    protected $guarded = ['created_at', 'updated_at', 'goto'];
    protected $dates = ['date'];

    // Relations
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
        return $this->{'meta_description_' . \App::getLocale()};
    }

    public function getMetaTitleAttribute()
    {
        return $this->{'meta_title_' . \App::getLocale()};
    }

    public function getTitleAttribute()
    {
        return $this->{'title_' . \App::getLocale()};
    }

    // Methods
    public function artistTimeline()
    {
        return $this->where('artist_id', $this->artist_id)
            ->orderBy('date')
            ->get()
            ->groupBy('date.year');
    }

    public function breadcrumb()
    {
        return "{$this->title} {$this->fullDate()}";
    }

    public function fullDate()
    {
        return $this->date->formatLocalized(trans('life.date.day_month_year'));
    }

    public function metaTitle()
    {
        return $this->meta_title ?: "{$this->title} &middot; {$this->fullDate()}";
    }

    public function shortDate()
    {
        return $this->date->formatLocalized(trans('life.date.day_month'));
    }

    public function template()
    {
        return 'life.gigs.'.str_replace('.', '_', $this->slug);
    }

    public function www()
    {
        return path('Life@page', $this->slug);
    }
}
