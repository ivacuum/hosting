<?php

namespace App;

use App\Domain\FileStatus;
use App\Observers\FileObserver;
use App\Policies\FilePolicy;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
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
#[ObservedBy(FileObserver::class)]
#[UsePolicy(FilePolicy::class)]
class File extends Model
{
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
        Model::withoutTimestamps(fn () => $this->increment('downloads'));

        event(new \App\Events\Stats\FileDownloadClicked);
    }

    #[\Override]
    protected function casts(): array
    {
        return [
            'size' => 'int',
            'status' => FileStatus::class,
            'downloads' => 'int',
        ];
    }
}
