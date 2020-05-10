<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title_ru
 * @property string $title_en
 * @property int $views
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @property \Illuminate\Support\Collection|News[] $news
 * @property \Illuminate\Support\Collection|Photo[] $photos
 * @property \Illuminate\Support\Collection|Photo[] $photosPublished
 *
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
    protected $guarded = ['created_at', 'updated_at', 'goto'];
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
        return $this->photos()->where('status', Photo::STATUS_PUBLISHED);
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

    public function wwwAcp(): string
    {
        return path([Http\Controllers\Acp\Tags::class, 'show'], $this);
    }
}
