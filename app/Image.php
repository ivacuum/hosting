<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Ivacuum\Generic\Services\ImageConverter;
use Ivacuum\Generic\Traits\RecordsActivity;

/**
 * @property int $id
 * @property int $user_id
 * @property string $slug
 * @property string $date
 * @property int $size
 * @property int $views
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @property User $user
 *
 * @mixin \Eloquent
 */
class Image extends Model
{
    use RecordsActivity;

    protected $guarded = ['created_at', 'updated_at', 'goto'];
    protected $perPage = 50;

    protected $casts = [
        'size' => 'int',
        'views' => 'int',
        'user_id' => 'int',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Methods
    public function breadcrumb(): string
    {
        return "#{$this->id}";
    }

    public function deleteFiles()
    {
        return \Storage::disk('gallery')->delete([
            "{$this->splittedDate()}/s/{$this->slug}",
            "{$this->splittedDate()}/t/{$this->slug}",
            "{$this->splittedDate()}/{$this->slug}",
        ]);
    }

    public static function newFromFile(UploadedFile $file, $userId)
    {
        $model = new self;
        $model->date = date('ymd');
        $model->size = 0;
        $model->slug = sprintf('%s_%s.%s', $userId, \Str::random(10), strtolower($file->getClientOriginalExtension()));
        $model->views = 0;
        $model->user_id = $userId;

        return $model;
    }

    public function originalUrl(): string
    {
        $date = \App::isProduction()
            ? $this->date
            : $this->splittedDate();

        return \Storage::disk('gallery')->url("{$date}/{$this->slug}");
    }

    public function originalSecretUrl(): string
    {
        return \Storage::disk('gallery-raw')->url("{$this->splittedDate()}/{$this->slug}");
    }

    public function resize(UploadedFile $file, $newWidth, $newHeight)
    {
        $source = $file->getRealPath();

        [$width, $height, $type] = getimagesize($source);

        // Даже маленькие исходники пересохраняем, чтобы повернуть их и почистить профили (exif, icc)
        if ($width <= $newWidth && $height <= $newHeight) {
            return $this->convertSmallSource($source);
        }

        if ($type === IMAGETYPE_GIF) {
            return $this->gifFirstFrame($source, $newWidth, $newHeight);
        }

        return $this->convert($source, $newWidth, $newHeight);
    }

    public function siteThumbnail(UploadedFile $file)
    {
        $thumbnail = $this->resize($file, 150, 150);

        return \Storage::disk('gallery')->putFileAs("{$this->splittedDate()}/t", $thumbnail, $this->slug);
    }

    public function splittedDate(): string
    {
        return implode('/', str_split($this->date, 2));
    }

    public function thumbnailUrl(): string
    {
        $date = \App::isProduction()
            ? $this->date
            : $this->splittedDate();

        return \Storage::disk('gallery')->url("{$date}/t/{$this->slug}");
    }

    public function thumbnailSecretUrl(): string
    {
        return \Storage::disk('gallery-raw')->url("{$this->splittedDate()}/t/{$this->slug}");
    }

    public function upload(UploadedFile $file)
    {
        $newFile = $this->resize($file, 2000, 2000);

        $this->size = $newFile->getSize();

        return \Storage::disk('gallery')->putFileAs($this->splittedDate(), $newFile, $this->slug);
    }

    private function convert($source, $width, $height)
    {
        return (new ImageConverter)
            ->autoOrient()
            ->resize($width, $height)
            ->filter('triangle')
            ->quality(75)
            ->convert($source);
    }

    private function convertSmallSource($source)
    {
        return (new ImageConverter)
            ->autoOrient()
            ->quality(75)
            ->convert($source);
    }

    private function gifFirstFrame($source, $width, $height)
    {
        return (new ImageConverter)
            ->firstFrame()
            ->resize($width, $height)
            ->convert($source);
    }
}
