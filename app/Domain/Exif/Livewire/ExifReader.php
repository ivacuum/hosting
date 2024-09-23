<?php

namespace App\Domain\Exif\Livewire;

use App\Domain\Exif\GetExifValueForHumansAction;
use App\Domain\Exif\ReadExifDataAction;
use Carbon\CarbonImmutable;
use Carbon\Exceptions\InvalidFormatException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ExifReader extends Component
{
    use WithFileUploads;

    #[Validate([
        'required',
        'image',
        'mimetypes:image/jpeg',
        'max:20480',
    ])]
    public TemporaryUploadedFile|string|null $image = null;

    public int $size = 0;
    public int $width = 0;
    public int $height = 0;
    public bool $read = false;
    public array $data = [];
    public CarbonImmutable|null $date = null;

    public function submit(ReadExifDataAction $readExifData): void
    {
        $this->validate();

        try {
            $this->data = $readExifData->execute($this->image->getRealPath());
            $this->read = true;
            $this->date = $this->parseDate();

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
            $this->data = [];
            $this->date = null;
            $this->size = $this->width = $this->height = 0;
        }

        $this->size = $this->image->getSize();
        [$this->width, $this->height] = getimagesize($this->image->getRealPath());
    }

    public function valueForHumans(string $key, int|array|string|null $value): string
    {
        return app(GetExifValueForHumansAction::class)->execute($key, $value);
    }

    private function parseDate(): CarbonImmutable|null
    {
        if (!isset($this->data['DateTime'])) {
            return null;
        }

        try {
            return CarbonImmutable::createFromFormat('Y:m:d H:i:s', $this->data['DateTime']);
        } catch (InvalidFormatException) {
            return CarbonImmutable::parse($this->data['DateTime']);
        }
    }
}
