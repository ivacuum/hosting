<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Model;

/**
 * Страна
 *
 * @property integer $id
 * @property string  $title
 * @property string  $slug
 * @property string  $emoji
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\City $cities
 * @property \App\Trip $trips
 */
class Country extends Model
{
    protected $fillable = ['title_ru', 'title_en', 'slug', 'emoji'];

    public function cities()
    {
        return $this->hasMany(City::class)
            ->orderBy("title_" . App::getLocale());
    }

    public function trips()
    {
        return $this->hasMany(Trip::class)
            ->orderBy('date_start', 'desc');
    }

    public function getTitleAttribute()
    {
        return $this->{'title_' . App::getLocale()};
    }
}
