<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Ivacuum\Generic\Services\ImageConverter;
use Ivacuum\Generic\Traits\RecordsActivity;

/**
 * Изображение в галерее
 *
 * @property int $id
 * @property int $user_id
 * @property string $slug
 * @property string $date
 * @property int $size
 * @property int $views
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property User $user
 *
 * @property-read string $splitted_date
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

    // Attributes
    public function getSplittedDateAttribute(): string
    {
        return implode('/', str_split($this->date, 2));
    }

    // Methods
    public function breadcrumb(): string
    {
        return "#{$this->id}";
    }

    public function deleteFiles()
    {
        return \Storage::disk('gallery')->delete([
            "{$this->splitted_date}/s/{$this->slug}",
            "{$this->splitted_date}/t/{$this->slug}",
            "{$this->splitted_date}/{$this->slug}",
        ]);
    }

    public function originalUrl(): string
    {
        return \App::environment() === 'production'
            ? "https://img.ivacuum.ru/g/{$this->date}/{$this->slug}"
            : url("/uploads/gallery/{$this->splitted_date}/{$this->slug}");
    }

    public function originalSecretUrl(): string
    {
        return \App::environment() === 'production'
            ? "https://ivacuum.org/g/{$this->splitted_date}/{$this->slug}"
            : "/uploads/gallery/{$this->splitted_date}/{$this->slug}";
    }

    public function resize(UploadedFile $file, $newWidth, $newHeight)
    {
        $source = $file->getRealPath();

        list($width, $height, $type) = getimagesize($source);

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

        return \Storage::disk('gallery')->putFileAs("{$this->splitted_date}/t", $thumbnail, $this->slug);
    }

    public function thumbnailUrl(): string
    {
        return \App::environment() === 'production'
            ? "https://img.ivacuum.ru/g/{$this->date}/t/{$this->slug}"
            : "/uploads/gallery/{$this->splitted_date}/t/{$this->slug}";
    }

    public function thumbnailSecretUrl(): string
    {
        return \App::environment() === 'production'
            ? "https://ivacuum.org/g/{$this->splitted_date}/t/{$this->slug}"
            : "/uploads/gallery/{$this->splitted_date}/t/{$this->slug}";
    }

    public function upload(UploadedFile $file)
    {
        $newFile = $this->resize($file, 2000, 2000);

        $this->size = $newFile->getSize();

        return \Storage::disk('gallery')->putFileAs($this->splitted_date, $newFile, $this->slug);
    }

    public static function createFromFile(UploadedFile $file, $userId)
    {
        return new static([
            'slug' => sprintf('%s_%s.%s', $userId, \Str::random(10), strtolower($file->getClientOriginalExtension())),
            'date' => date('ymd'),
            'size' => 0,
            'views' => 0,
            'user_id' => $userId,
        ]);
    }

    protected function convert($source, $width, $height)
    {
        return (new ImageConverter)
            ->autoOrient()
            ->resize($width, $height)
            ->filter('triangle')
            ->quality(75)
            ->convert($source);
    }

    protected function convertSmallSource($source)
    {
        return (new ImageConverter)
            ->autoOrient()
            ->quality(75)
            ->convert($source);
    }

    protected function gifFirstFrame($source, $width, $height)
    {
        return (new ImageConverter)
            ->firstFrame()
            ->resize($width, $height)
            ->convert($source);
    }
}
