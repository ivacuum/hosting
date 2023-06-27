<?php

namespace App;

use App\Domain\FileStatus;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $folder
 * @property string $title
 * @property string $slug
 * @property int $size
 * @property string $extension
 * @property FileStatus $status
 * @property int $downloads
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @mixin \Eloquent
 */
class File extends Model
{
    protected $perPage = 50;

    protected $casts = [
        'size' => 'int',
        'status' => FileStatus::class,
        'downloads' => 'int',
    ];

    protected $attributes = [
        'folder' => '',
        'status' => FileStatus::Published,
        'downloads' => 0,
    ];

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
        $folder = $this->folder
            ? "{$this->folder}/"
            : '';

        return \Storage::disk('files')->url($folder . $this->basename());
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
}
