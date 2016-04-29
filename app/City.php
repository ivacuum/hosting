<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Город
 *
 * @property integer $id
 * @property integer $country_id
 * @property string  $title
 * @property string  $slug
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\Country $country
 * @property \App\Trip    $trips
 */
class City extends Model
{
    protected $fillable = ['country_id', 'title', 'slug', 'iata'];

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

    public function getInitial()
    {
        return mb_substr($this->title, 0, 1);
    }

    public function getTripsCount()
    {
        return $this->tripsCount ? $this->tripsCount->count : 0;
    }
}
