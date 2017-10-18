<?php namespace App;

use App\Traits\HasLocalizedTitle;
use App\Traits\HasTripsMetaDescription;
use Illuminate\Database\Eloquent\Model;

/**
 * Страна
 *
 * @property integer $id
 * @property string  $title_ru
 * @property string  $title_en
 * @property string  $slug
 * @property string  $emoji
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property-read \App\City $cities
 * @property-read \App\Trip $trips
 *
 * @property-read string  $title
 *
 * @mixin \Eloquent
 */
class Country extends Model
{
    use HasLocalizedTitle,
        HasTripsMetaDescription;

    protected $guarded = ['created_at', 'updated_at', 'goto'];

    // Relations
    public function cities()
    {
        return $this->hasMany(City::class)
            ->orderBy(self::titleField());
    }

    public function trips()
    {
        return $this->hasManyThrough(Trip::class, City::class)
            ->orderBy('date_start', 'asc');
    }

    // Methods
    public function breadcrumb(): string
    {
        return "{$this->emoji} {$this->title}";
    }

    public static function forInputSelect()
    {
        $title_field = self::titleField();

        return self::orderBy($title_field)->get(['id', $title_field])->pluck($title_field, 'id');
    }

    public function initial(): string
    {
        return mb_substr($this->title, 0, 1);
    }

    public function metaTitle(): string
    {
        return "{$this->emoji} {$this->title}";
    }

    public function www(): string
    {
        return path('Life@country', $this->slug);
    }
}
