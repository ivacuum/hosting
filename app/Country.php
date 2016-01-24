<?php

namespace App;

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
    protected $fillable = ['title', 'slug', 'emoji'];

    public function cities()
    {
        return $this->hasMany(City::class)
            ->orderBy('title');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class)
            ->orderBy('date_start', 'desc');
    }
}
