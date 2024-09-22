<?php

namespace App\Domain\Exif\Livewire;

use App\Domain\Exif\GetExifValueForHumansAction;
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

    public function submit(): void
    {
        $this->validate();

        try {
            $this->data = exif_read_data($this->image->getRealPath());

            foreach ($this->data as $key => $value) {
                if (mb_check_encoding($value, 'UTF-8')) {
                    continue;
                }

                if (!str_starts_with($key, 'UndefinedTag:')) {
                    continue;
                }

                unset($this->data[$key]);
            }

            $this->read = true;

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
            $this->size = $this->width = $this->height = 0;
        }

        $this->size = $this->image->getSize();
        [$this->width, $this->height] = getimagesize($this->image->getRealPath());
    }

    public function valueForHumans(string $key, int|array|string|null $value): string
    {
        return app(GetExifValueForHumansAction::class)->execute($key, $value);
    }
}
