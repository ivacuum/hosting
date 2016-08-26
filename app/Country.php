<?php namespace App;

use App;
use Illuminate\Database\Eloquent\Model;

/**
 * Страна
 *
 * @property integer $id
 * @property string  $title_ru
 * @property string  $title_en
 * @property string  $slug
 * @property string  $emoji
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property-read \App\City $cities
 * @property-read \App\Trip $trips
 *
 * @property-read string  $title
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
