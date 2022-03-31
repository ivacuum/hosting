<?php namespace App;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Finder\Finder;

/**
 * @property int $id
 * @property int $city_id
 * @property int $artist_id
 * @property string $title_ru
 * @property string $title_en
 * @property string $slug
 * @property \Carbon\CarbonImmutable $date
 * @property Domain\GigStatus $status
 * @property string $meta_title_ru
 * @property string $meta_title_en
 * @property string $meta_description_ru
 * @property string $meta_description_en
 * @property string $meta_image
 * @property int $views
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @property Artist $artist
 * @property City $city
 * @property \Illuminate\Database\Eloquent\Collection|Email[] $emails
 *
 * @property-read string $meta_title
 * @property-read string $meta_description
 * @property-read string $title
 * @property-read int $year
 *
 * @mixin \Eloquent
 */
class Gig extends Model
{
    use Traits\HasLocalizedTitle;

    protected $guarded = ['created_at', 'updated_at', 'goto'];
    protected $dates = ['date'];

    protected $casts = [
        'views' => 'int',
        'status' => Domain\GigStatus::class,
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

    public function photos()
    {
        return $this->morphMany(Photo::class, 'rel');
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

    public function getYearAttribute(): int
    {
        return $this->date->year;
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

    public function createStoryFile(): bool
    {
        return touch(resource_path("views/{$this->templatePath()}.blade.php"));
    }

    public function date(): CarbonInterface
    {
        return $this->date;
    }

    public function deleteStoryFile(): bool
    {
        return unlink(resource_path("views/{$this->templatePath()}.blade.php"));
    }

    public function fullDate(): string
    {
        return $this->date->formatLocalized(__('life.date.day_month_year'));
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
        return $this->date->formatLocalized(__('life.date.day_month'));
    }

    public function template(): string
    {
        return 'life.gigs.' . str_replace('.', '_', $this->slug);
    }

    public function templatePath(): string
    {
        return str_replace('.', '/', $this->template());
    }

    /**
     * @return \Symfony\Component\Finder\Finder|\Symfony\Component\Finder\SplFileInfo[]
     */
    public static function templatesIterator()
    {
        return Finder::create()
            ->files()
            ->in(resource_path('views/life/gigs'))
            ->name('*.blade.php')
            ->notName('base.blade.php')
            ->sortByName();
    }

    public function www(): string
    {
        return path([Http\Controllers\Life::class, 'page'], $this->slug);
    }

    public function wwwAcp(): string
    {
        return path([Http\Controllers\Acp\Gigs::class, 'show'], $this);
    }

    public function wwwLocale(string $locale = ''): string
    {
        return path_locale([Http\Controllers\Life::class, 'page'], $this->slug, false, $locale);
    }
}
