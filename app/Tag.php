<?php namespace App;

use App\Traits\HasLocalizedTitle;
use Illuminate\Database\Eloquent\Model;

/**
 * Тэг
 *
 * @property integer $id
 * @property string  $title_ru
 * @property string  $title_en
 * @property integer $views
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property \Illuminate\Support\Collection $photos
 *
 * @property-read string  $title
 *
 * @mixin \Eloquent
 */
class Tag extends Model
{
    use HasLocalizedTitle;

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

    public function photos_published()
    {
        return $this->photos()->where('status', Photo::STATUS_PUBLISHED);
    }

    // Events
    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Tag $tag) {
            \DB::transaction(function () use ($tag) {
                foreach ($tag->photos as $photo) {
                    $photo->tags()->detach($tag->id);
                }
            });
        });
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
}
