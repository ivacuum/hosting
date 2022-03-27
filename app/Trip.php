<?php namespace App;

use App\Domain\TripStatus;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Ivacuum\Generic\Utilities\TextImagesParser;
use League\CommonMark\CommonMarkConverter;

/**
 * @property int $id
 * @property int $city_id
 * @property int $user_id
 * @property string $title_ru
 * @property string $title_en
 * @property string $slug
 * @property \Carbon\CarbonImmutable $date_start
 * @property \Carbon\CarbonImmutable $date_end
 * @property Domain\TripStatus $status
 * @property string $markdown
 * @property string $html
 * @property string $meta_title_ru
 * @property string $meta_title_en
 * @property string $meta_description_ru
 * @property string $meta_description_en
 * @property string $meta_image
 * @property int $views
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @property City $city
 * @property \Illuminate\Support\Collection|Comment[] $comments
 * @property \Illuminate\Support\Collection|Comment[] $commentsPublished
 * @property Country $country
 * @property \Illuminate\Database\Eloquent\Collection|Email[] $emails
 * @property \Illuminate\Database\Eloquent\Collection|Photo[] $photos
 * @property User $user
 *
 * @method static Builder next()
 * @method static Builder previous(int $nextTrips)
 * @method static Builder published()
 * @method static Builder visible()
 *
 * @property-read int $comments_count
 * @property-read string $meta_title
 * @property-read string $meta_description
 * @property int $photos_count
 * @property-read string $title
 * @property-read int $year
 *
 * @mixin \Eloquent
 */
class Trip extends Model
{
    use Traits\HasLocalizedTitle;

    const COLUMNS_LIST = [
        'id',
        'user_id',
        'city_id',
        'title_ru',
        'title_en',
        'slug',
        'date_start',
        'date_end',
        'status',
        'views',
    ];

    protected $attributes = [
        'status' => TripStatus::Inactive,
    ];

    protected $guarded = ['id', 'html', 'views', 'created_at', 'updated_at'];
    protected $dates = ['date_start', 'date_end'];

    protected $casts = [
        'views' => 'int',
        'status' => Domain\TripStatus::class,
        'city_id' => 'int',
        'user_id' => 'int',
    ];

    // Relations
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'rel');
    }

    public function commentsPublished()
    {
        return $this->comments()->where('status', Domain\CommentStatus::Published);
    }

    public function emails()
    {
        return $this->morphMany(Email::class, 'rel');
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'rel');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeNext(Builder $query)
    {
        return $query->where('user_id', $this->user_id)
            ->where('date_start', '>=', $this->date_start)
            ->where('status', TripStatus::Published)
            ->where('id', '<>', $this->id)
            ->orderBy('date_start')
            ->take(2);
    }

    public function scopePrevious(Builder $query, int $nextTrips = 2)
    {
        // Всего 4 места под ссылки помимо текущей поездки
        // prev prev current next next
        // При просмотре последней поездки будет
        // prev prev prev prev current
        $take = 4 - $nextTrips;

        return $query->where('user_id', $this->user_id)
            ->where('date_start', '<=', $this->date_start)
            ->where('status', TripStatus::Published)
            ->where('id', '<>', $this->id)
            ->orderByDesc('date_start')
            ->take($take);
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('status', TripStatus::Published);
    }

    public function scopeVisible(Builder $query)
    {
        return $query->where('status', '!=', TripStatus::Hidden);
    }

    // Attributes
    public function getMetaDescriptionAttribute(): string
    {
        return $this->{'meta_description_' . \App::getLocale()};
    }

    public function getMetaTitleAttribute(): string
    {
        return $this->{'meta_title_' . \App::getLocale()};
    }

    public function getYearAttribute(): int
    {
        return $this->date_start->year;
    }

    public function setMarkdownAttribute(string $value): void
    {
        $this->attributes['markdown'] = $value;

        $converter = new CommonMarkConverter([
            'max_nesting_level' => 15,
            'allow_unsafe_links' => false,
        ]);

        $this->attributes['html'] = $converter->convert((new TextImagesParser)->parse($value))->getContent();
    }

    public function setSlugAttribute(string $value): void
    {
        $this->attributes['slug'] = mb_strtolower($value);
    }

    // Methods
    public function breadcrumb(): string
    {
        return $this->title;
    }

    public function cityTimeline()
    {
        return $this->where('user_id', $this->user_id)
            ->where('city_id', $this->city_id)
            ->where('status', '<>', TripStatus::Hidden)
            ->orderBy('date_start')
            ->get()
            ->groupBy('year');
    }

    public function createStoryFile(): bool
    {
        return touch(resource_path("views/{$this->templatePath()}.blade.php"));
    }

    public function date(): CarbonInterface
    {
        return $this->date_start;
    }

    public function deleteStoryFile(): bool
    {
        return unlink(resource_path("views/{$this->templatePath()}.blade.php"));
    }

    public function imgAltText(): string
    {
        return "{$this->city->country->emoji} {$this->title}, {$this->city->country->title}, {$this->timelinePeriodWithYear()}.";
    }

    public function loadCity(): void
    {
        if (!$this->relationLoaded('city')) {
            $this->setRelation('city', \CityHelper::findById($this->city_id));
        }
    }

    public function loadCityAndCountry(): void
    {
        $this->loadCity();
        $this->city->loadCountry();
    }

    public function localizedDate(): string
    {
        if ($this->date_end->isSameDay($this->date_start)) {
            return trim($this->date_start->formatLocalized(__('life.date.day_month_year')));
        }

        if ($this->date_start->month !== $this->date_end->month) {
            return sprintf(
                __('life.date.day_month_day_month_year'),
                $this->date_start->day,
                $this->date_start->formatLocalized('%B'),
                $this->date_end->day,
                $this->date_end->formatLocalized('%B'),
                $this->date_end->formatLocalized('%Y')
            );
        }

        return sprintf(
            __('life.date.day_day_month_year'),
            $this->date_start->day,
            $this->date_end->day,
            $this->date_start->formatLocalized('%B'),
            $this->date_start->formatLocalized('%Y')
        );
    }

    public function localizedDateWithoutYear(): string
    {
        if ($this->date_end->isSameDay($this->date_start)) {
            return trim($this->date_start->formatLocalized(__('life.date.day_month')));
        }

        if ($this->date_start->month !== $this->date_end->month) {
            return sprintf(
                __('life.date.day_month_day_month'),
                $this->date_start->day,
                $this->date_start->formatLocalized('%B'),
                $this->date_end->day,
                $this->date_end->formatLocalized('%B')
            );
        }

        return sprintf(
            __('life.date.day_day_month'),
            $this->date_start->day,
            $this->date_end->day,
            $this->date_start->formatLocalized('%B')
        );
    }

    public function metaDescription(): string
    {
        return $this->meta_description;
    }

    public function metaImage(?int $width = null, ?int $height = null): string
    {
        if (!$this->meta_image) {
            return '';
        }

        if (str_starts_with($this->meta_image, 'http')) {
            return $this->meta_image;
        }

        if ($width && $height) {
            return \ViewHelper::picArbitrary($width, $height, $this->slug, $this->meta_image);
        }

        return \ViewHelper::pic($this->slug, $this->meta_image);
    }

    public function metaTitle(): string
    {
        if ($this->meta_title) {
            return $this->meta_title;
        }

        $suffix = '';

        if (isset($this->photos_count) && $this->photos_count > 0) {
            $suffix = " · " . \ViewHelper::plural('photos', $this->photos_count);
        }

        return "{$this->title} · {$this->localizedDate()}{$suffix}";
    }

    public function period(): string
    {
        if ($this->date_start->isSameMonth($this->date_end)) {
            return $this->date_start->isoFormat('MMMM');
        }

        return $this->date_start->isoFormat('MMMM') . '–' . $this->date_end->isoFormat('MMMM');
    }

    public function template(): string
    {
        return 'life.trips.' . str_replace('.', '_', $this->slug);
    }

    public function templatePath(): string
    {
        return str_replace('.', '/', $this->template());
    }

    public function timelinePeriod(): string
    {
        return $this->date_start->isoFormat('MMMM');
    }

    public function timelinePeriodWithYear(): string
    {
        return $this->date_start->isoFormat('MMMM YYYY');
    }

    public function www(?string $anchor = null): string
    {
        return $this->user_id === 1
            ? path([Http\Controllers\Life::class, 'page'], $this->slug) . $anchor
            : path([Http\Controllers\UserTravelTrips::class, 'show'], [$this->user->login, $this->slug]) . $anchor;
    }

    public function wwwLocale(?string $anchor = null, string $locale = ''): string
    {
        return $this->user_id === 1
            ? path_locale([Http\Controllers\Life::class, 'page'], $this->slug, false, $locale) . $anchor
            : path_locale([Http\Controllers\UserTravelTrips::class, 'show'], [$this->user->login, $this->slug], false, $locale) . $anchor;
    }
}
