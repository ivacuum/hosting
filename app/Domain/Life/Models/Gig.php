<?php

namespace App\Domain\Life\Models;

use App\Domain\Life\GigStatus;
use App\Domain\Life\Observer\GigObserver;
use App\Domain\Life\Policy\GigPolicy;
use App\Email;
use App\Http\Controllers\LifeController;
use App\Traits;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $city_id
 * @property int $artist_id
 * @property string $title_ru
 * @property string $title_en
 * @property string $slug
 * @property \Carbon\CarbonImmutable $date
 * @property GigStatus $status
 * @property string $meta_title_ru
 * @property string $meta_title_en
 * @property string $meta_description_ru
 * @property string $meta_description_en
 * @property string $meta_image
 * @property int $views
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property Artist $artist
 * @property City $city
 * @property \Illuminate\Database\Eloquent\Collection<int, Email> $emails
 * @property-read string $title
 * @property-read int $year
 *
 * @mixin \Eloquent
 */
#[ObservedBy(GigObserver::class)]
#[UsePolicy(GigPolicy::class)]
class Gig extends Model
{
    use Traits\HasLocalizedTitle;

    protected $attributes = [
        'status' => GigStatus::Hidden,
        'meta_image' => '',
        'meta_description_en' => '',
        'meta_description_ru' => '',
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
        return $this->date->isoFormat(__('life.date.day_month_year'));
    }

    public function metaDescription(): string
    {
        return $this->{'meta_description_' . \App::getLocale()};
    }

    public function metaTitle(): string
    {
        $metaTitle = $this->{'meta_title_' . \App::getLocale()};

        return $metaTitle ?: "{$this->title} · {$this->fullDate()}";
    }

    public function shortDate(): string
    {
        return $this->date->isoFormat(__('life.date.day_month'));
    }

    public function template(): string
    {
        return 'life.gigs.' . str_replace('.', '_', $this->slug);
    }

    public function templatePath(): string
    {
        return str_replace('.', '/', $this->template());
    }

    public function www(): string
    {
        return to('life/{slug}', $this->slug);
    }

    public function wwwLocale(string $locale = ''): string
    {
        return path_locale([LifeController::class, 'page'], $this->slug, false, $locale);
    }

    #[\Override]
    protected function casts(): array
    {
        return [
            'date' => 'datetime',
            'views' => 'int',
            'status' => GigStatus::class,
            'city_id' => 'int',
            'artist_id' => 'int',
        ];
    }

    #[\Override]
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    protected function year(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->date->year,
        );
    }
}
