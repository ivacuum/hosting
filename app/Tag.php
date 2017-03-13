<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Тэг
 *
 * @property integer $id
 * @property string  $title_ru
 * @property string  $title_en
 * @property integer $views
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property-read string  $title
 */
class Tag extends Model
{
    protected $guarded = ['created_at', 'updated_at', 'goto'];
    protected $perPage = 50;

    public function news()
    {
        return $this->morphedByMany(News::class, 'rel', 'taggable');
    }

    public function photos()
    {
        return $this->morphedByMany(Photo::class, 'rel', 'taggable');
    }

    public function getTitleAttribute()
    {
        return $this->{self::titleField()};
    }

    public static function titleField()
    {
        return 'title_'.\App::getLocale();
    }

    public function initial()
    {
        return mb_substr($this->title, 0, 1);
    }
}
