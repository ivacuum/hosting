<?php namespace App;

use App\Traits\HasLocalizedTitle;
use App\Traits\HasTripsMetaDescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Город
 *
 * @property integer $id
 * @property integer $country_id
 * @property string  $title_ru
 * @property string  $title_en
 * @property string  $slug
 * @property string  $iata
 * @property string  $lat
 * @property string  $lon
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property-read \App\Country $country
 * @property-read \App\Trip    $trips
 *
 * @property-read string  $title
 *
 * @mixin \Eloquent
 */
class City extends Model
{
    use HasLocalizedTitle,
        HasTripsMetaDescription;

    protected $guarded = ['created_at', 'updated_at', 'goto'];
    protected $perPage = 50;

    // Relations
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class)
            ->orderBy('date_start', 'asc');
    }

    // Methods
    public function breadcrumb(): string
    {
        return "{$this->country->emoji} {$this->title}";
    }

    public static function forInputSelect(): Collection
    {
        $title_field = static::titleField();

        return static::orderBy($title_field)->get(['id', $title_field])->pluck($title_field, 'id');
    }

    public function initial(): string
    {
        return mb_substr($this->title, 0, 1);
    }

    public function isOnMap(): bool
    {
        return $this->lat && $this->lon;
    }

    public function metaTitle(): string
    {
        return "{$this->country->emoji} {$this->title}, {$this->country->title}";
    }

    public function www(): string
    {
        return path('Life@page', $this->slug);
    }
}
