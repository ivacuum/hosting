<?php namespace App;

use App\Traits\HasLocalizedTitle;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Finder\Finder;

/**
 * Концерт
 *
 * @property integer $id
 * @property integer $city_id
 * @property integer $artist_id
 * @property string  $title_ru
 * @property string  $title_en
 * @property string  $slug
 * @property \Illuminate\Support\Carbon $date
 * @property integer $status
 * @property string  $meta_title_ru
 * @property string  $meta_title_en
 * @property string  $meta_description_ru
 * @property string  $meta_description_en
 * @property string  $meta_image
 * @property integer $views
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property \App\Artist $artist
 * @property \App\City $city
 * @property \Illuminate\Database\Eloquent\Collection|\App\Email[] $emails
 *
 * @property-read string  $title
 * @property-read string  $meta_title
 * @property-read string  $meta_description
 *
 * @mixin \Eloquent
 */
class Gig extends Model
{
    use HasLocalizedTitle;

    const STATUS_HIDDEN = 0;
    const STATUS_PUBLISHED = 1;

    protected $guarded = ['created_at', 'updated_at', 'goto'];
    protected $dates = ['date'];

    protected $casts = [
        'views' => 'int',
        'status' => 'int',
        'city_id' => 'int',
        'artist_id' => 'int',
    ];

    // Relations
    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function emails()
    {
        return $this->morphMany(Email::class, 'rel');
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

    // Methods
    public function artistTimeline()
    {
        return $this->where('artist_id', $this->artist_id)
            ->orderBy('date')
            ->get()
            ->groupBy('date.year');
    }

    public function breadcrumb(): string
    {
        return $this->title;
    }

    public function fullDate(): string
    {
        return $this->date->formatLocalized(trans('life.date.day_month_year'));
    }

    public function metaDescription(): string
    {
        return $this->meta_description;
    }

    public function metaTitle(): string
    {
        return $this->meta_title ?: "{$this->title} · {$this->fullDate()}";
    }

    public function shortDate(): string
    {
        return $this->date->formatLocalized(trans('life.date.day_month'));
    }

    public function template(): string
    {
        return 'life.gigs.'.str_replace('.', '_', $this->slug);
    }

    /**
     * @return \Symfony\Component\Finder\Finder|\Symfony\Component\Finder\SplFileInfo[]
     */
    public static function templatesIterator()
    {
        return Finder::create()
            ->files()
            ->in(base_path('resources/views/life/gigs'))
            ->name('*.blade.php')
            ->notName('base.blade.php')
            ->sortByName();
    }

    public function www(): string
    {
        return path('Life@page', $this->slug);
    }

    public function wwwLocale(string $locale = ''): string
    {
        return path_locale('Life@page', $this->slug, false, $locale);
    }
}
