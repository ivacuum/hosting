<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Изображение в галерее
 *
 * @property integer $id
 * @property integer $user_id
 * @property string  $slug
 * @property string  $date
 * @property integer $size
 * @property integer $views
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\User $user
 *
 * @property-read string  $splitted_date
 */
class Image extends Model
{
    protected $guarded = ['created_at', 'updated_at'];
    protected $perPage = 50;

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
        return "https://img.ivacuum.ru/g/{$this->date}/{$this->slug}";
    }

    public function originalSecretUrl()
    {
        return "https://ivacuum.org/g/{$this->splitted_date}/{$this->slug}";
    }

    public function thumbnailUrl()
    {
        return "https://img.ivacuum.ru/g/{$this->date}/t/{$this->slug}";
    }

    public function thumbnailSecretUrl()
    {
        return "https://ivacuum.org/g/{$this->splitted_date}/t/{$this->slug}";
    }
}
