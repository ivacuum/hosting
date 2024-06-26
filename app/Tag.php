<?php

namespace App;

use App\Observers\TagObserver;
use App\Scope\PhotoPublishedScope;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title_ru
 * @property string $title_en
 * @property int $views
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property \Illuminate\Support\Collection<int, News> $news
 * @property \Illuminate\Support\Collection<int, Photo> $photos
 * @property \Illuminate\Support\Collection<int, Photo> $photosPublished
 * @property-read int $photos_count
 * @property-read string $title
 *
 * @mixin \Eloquent
 */
#[ObservedBy(TagObserver::class)]
class Tag extends Model
{
    use Traits\HasLocalizedTitle;

    // Relations
    public function news()
    {
        return $this->morphedByMany(News::class, 'rel', 'taggable');
    }

    public function photos()
    {
        return $this->morphedByMany(Photo::class, 'rel', 'taggable');
    }

    public function photosPublished()
    {
        return $this->photos()->tap(new PhotoPublishedScope);
    }

    // Methods
    public function breadcrumb(): string
    {
        return "#{$this->title}";
    }

    public function initial(): string
    {
        return mb_substr($this->title, 0, 1);
    }

    public function www(): string
    {
        return to('photos/tags/{tag}', $this);
    }

    #[\Override]
    protected function casts(): array
    {
        return [
            'views' => 'int',
        ];
    }
}
