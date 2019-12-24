<?php namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Файлы для скачивания
 *
 * @property int $id
 * @property string $folder
 * @property string $title
 * @property string $slug
 * @property int $size
 * @property string $extension
 * @property int $status
 * @property int $downloads
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @mixin \Eloquent
 */
class File extends Model
{
    const STATUS_HIDDEN = 0;
    const STATUS_PUBLISHED = 1;

    protected $guarded = ['created_at', 'updated_at', 'goto', 'file'];
    protected $perPage = 50;

    protected $casts = [
        'size' => 'int',
        'status' => 'int',
        'downloads' => 'int',
    ];

    // Scopes
    public function scopePublished(Builder $query)
    {
        return $query->where('status', static::STATUS_PUBLISHED);
    }

    // Methods
    public function basename()
    {
        return "{$this->slug}.{$this->extension}";
    }

    public function breadcrumb()
    {
        return $this->title;
    }

    public function downloadPath()
    {
        return "https://ivacuum.org/d/" . ($this->folder ? "{$this->folder}/" : '') . "{$this->basename()}";
    }

    public function headerBasename()
    {
        return "filename*=utf-8''" . rawurlencode(htmlspecialchars_decode($this->basename()));
    }

    public function incrementDownloads(): void
    {
        $this->timestamps = false;
        $this->increment('downloads');
        $this->timestamps = true;

        event(new \App\Events\Stats\FileDownloadClicked);
    }

    public function isPublished(): bool
    {
        return $this->status === self::STATUS_PUBLISHED;
    }
}
