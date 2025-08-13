<?php

namespace App\Domain\Exif\Livewire;

use App\Domain\Exif\DivideExifValueAction;
use App\Domain\Exif\GetExifValueForHumansAction;
use App\Domain\Exif\GetTakenAtFromExifDataAction;
use App\Domain\Exif\Jobs\DeleteTempLivewireFileJob;
use App\Domain\Exif\RateLimit\ExifReaderRateLimiter;
use App\Domain\Exif\ReadExifDataAction;
use App\Domain\Exif\ShouldDeleteImageForTestAction;
use Carbon\CarbonImmutable;
use Ivacuum\Generic\Utilities\ExifHelper;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\FileUploadConfiguration;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ExifReader extends Component
{
    use WithFileUploads;

    #[Validate([
        'required',
        'max:20480',
    ])]
    #[Validate('mimetypes:image/jpeg', message: 'Не сможем прочитать этот файл. Пожалуйста, выберите изображение в формате JPEG.')]
    public TemporaryUploadedFile|string|null $image = null;

    public int $size = 0;
    public int $width = 0;
    public int $height = 0;
    public int|null $gpsImageDirection = null;
    public bool $read = false;
    public array $data = [];
    public string|null $lat = null;
    public string|null $lon = null;
    public CarbonImmutable|null $date = null;

    public function submit(
        GetTakenAtFromExifDataAction $getTakenAtFromExifData,
        ReadExifDataAction $readExifData,
        ShouldDeleteImageForTestAction $shouldDeleteImageForTest,
        ExifReaderRateLimiter $rateLimiter,
    ): void {
        if ($shouldDeleteImageForTest->execute()) {
            // Не найден другой способ протестировать попытку чтения удаленного файла
            \Storage::disk(FileUploadConfiguration::disk())
                ->delete(FileUploadConfiguration::directory() . '/' . $this->image->getFilename());
        }

        if (!$this->image->exists()) {
            $this->addError('image', 'Файл уже удален с сервера. Загрузите его, пожалуйста, еще раз.');

            $this->resetData();
            $this->image = null;

            return;
        }

        $this->validate();

        if ($rateLimiter->tooManyAttempts()) {
            $this->resetData();
            $this->image = null;

            $this->addError('image', __('Достигнут ежечасный лимит чтения файлов. Видимо, большой наплыв желающих воспользоваться сервисом. Продолжить читать файлы можно будет через час.'));

            return;
        }

        try {
            $this->data = $readExifData->execute($this->image->getRealPath());
            $this->read = true;
            $this->date = $getTakenAtFromExifData->execute($this->data);
            [
                'lat' => $this->lat,
                'lon' => $this->lon
            ] = ExifHelper::latLon($this->data);
            $this->gpsImageDirection = ($this->data['GPSImgDirection'] ?? null)
                ? app(DivideExifValueAction::class)->execute($this->data['GPSImgDirection'])
                : null;

            unset(
                $this->data['COMPUTED'],
                $this->data['SectionsFound'],
                $this->data['MimeType'],
                $this->data['FileType'],
                $this->data['FileSize'],
                $this->data['FileDateTime'],
                $this->data['FileName'],
            );
        } catch (\Throwable $e) {
            $this->addError('image', $e->getMessage());
            $this->lat = $this->lon = null;
            $this->data = [];
            $this->date = null;
            $this->size = $this->width = $this->height = 0;
            $this->gpsImageDirection = null;
        }

        $this->size = $this->image->getSize();
        [$this->width, $this->height] = getimagesize($this->image->getRealPath()) ?: [0, 0];
    }

    public function updatedImage()
    {
        $this->resetData();

        dispatch(new DeleteTempLivewireFileJob($this->image->getFilename()));
    }

    public function valueForHumans(string $key, int|array|string|null $value): string
    {
        return app(GetExifValueForHumansAction::class)->execute($key, $value);
    }

    private function resetData(): void
    {
        $this->lat = $this->lon = null;
        $this->data = [];
        $this->date = null;
        $this->read = false;
        $this->size = $this->width = $this->height = 0;
        $this->gpsImageDirection = null;
    }
}
