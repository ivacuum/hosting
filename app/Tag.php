<?php

namespace App;

use App\Scope\PhotoPublishedScope;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title_ru
 * @property string $title_en
 * @property int $views
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property \Illuminate\Support\Collection|News[] $news
 * @property \Illuminate\Support\Collection|Photo[] $photos
 * @property \Illuminate\Support\Collection|Photo[] $photosPublished
 * @property-read int $photos_count
 * @property-read string $title
 *
 * @mixin \Eloquent
 */
class Tag extends Model
{
    use Traits\HasLocalizedTitle;

    protected $casts = [
        'views' => 'int',
    ];
    protected $perPage = 50;

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
}
