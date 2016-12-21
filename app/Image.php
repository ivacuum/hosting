<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Изображение в галерее
 *
 * @property integer $id
 * @property integer $user_id
 * @property string  $slug
 * @property string  $date
 * @property integer $time
 * @property integer $size
 * @property integer $views
 * @property integer $touch
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\User $user
 *
 * @property-read string  $splitted_date
 */
class Image extends Model
{
    protected $connection = 'remote_mysql';
    protected $table = 'site_images';
    protected $guarded = ['created_at', 'updated_at'];
    protected $perPage = 50;
    protected $primaryKey = 'image_id';

    const ID = 'image_id';
    const SLUG = 'image_url';
    const DATE = 'image_date';
    const SIZE = 'image_size';
    const TOUCH = 'image_touch';
    const VIEWS = 'image_views';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Events
    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Image $image) {
            $image->deleteFiles();
        });
    }

    public function getIdAttribute()
    {
        return $this->attributes['image_id'];
    }

    public function getDateAttribute()
    {
        return $this->attributes['image_date'];
    }

    public function getSlugAttribute()
    {
        return $this->attributes['image_url'];
    }

    public function getSizeAttribute()
    {
        return $this->attributes['image_size'];
    }

    public function getTouchAttribute()
    {
        return $this->attributes['image_touch'];
    }

    public function getViewsAttribute()
    {
        return $this->attributes['image_views'];
    }

    public function getSplittedDateAttribute()
    {
        return implode('/', str_split($this->date, 2));
    }

    public function deleteFiles()
    {
        $files = [
            "g/{$this->splitted_date}/s/{$this->slug}",
            "g/{$this->splitted_date}/t/{$this->slug}",
            "g/{$this->splitted_date}/{$this->slug}",
        ];

        return \Storage::disk('ftp')->delete($files);
    }

    public function originalUrl()
    {
        return "http://img.ivacuum.ru/g/{$this->date}/{$this->slug}";
    }

    public function originalSecretUrl()
    {
        return "http://ivacuum.org/g/{$this->splitted_date}/{$this->slug}";
    }

    public function thumbnailUrl()
    {
        return "http://img.ivacuum.ru/g/{$this->date}/t/{$this->slug}";
    }

    public function thumbnailSecretUrl()
    {
        return "http://ivacuum.org/g/{$this->splitted_date}/t/{$this->slug}";
    }
}
