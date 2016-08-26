<?php namespace App;

use App;
use Illuminate\Database\Eloquent\Model;

/**
 * Город
 *
 * @property integer $id
 * @property integer $country_id
 * @property string  $title_ru
 * @property string  $title_en
 * @property string  $slug
 * @property string  $iata
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property-read \App\Country $country
 * @property-read \App\Trip    $trips
 *
 * @property-read string  $title
 */
class City extends Model
{
    protected $fillable = ['country_id', 'title_ru', 'title_en', 'slug', 'iata'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class)
            ->orderBy('date_start', 'desc');
    }

    public function tripsCount()
    {
        return $this->hasOne(Trip::class)
            ->selectRaw('city_id, count(*) as count')
            ->groupBy('city_id');
    }

    public function getTitleAttribute()
    {
        return $this->{'title_' . App::getLocale()};
    }

    public function getInitial()
    {
        return mb_substr($this->title, 0, 1);
    }

    public function getTripsCount()
    {
        return $this->tripsCount ? $this->tripsCount->count : 0;
    }
}
