<?php

namespace App\Http\Livewire;

use App\Photo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Ivacuum\Generic\Services\ImageConverter;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ThumbnailMaker extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public int $total = 0;
    public int $uploaded = 0;
    public array $thumbnails = [];
    public TemporaryUploadedFile|string|null $file = null;

    public function rules()
    {
        return [
            'file' => [
                'required',
                'image',
                'mimetypes:image/jpeg,image/png',
                'max:12288',
            ],
        ];
    }

    public function updatedFile()
    {
        $this->authorize('create', Photo::class);
        $this->validate();

        $image = (new ImageConverter)
            ->autoOrient()
            ->resize(2000, 2000)
            ->quality(75)
            ->convert($this->file->getRealPath());

        $pathInfo = pathinfo($this->file->getClientOriginalName());
        $extension = str_replace('jpeg', 'jpg', strtolower($pathInfo['extension']));
        $filename = "{$pathInfo['filename']}.{$extension}";

        \Storage::disk('temp')->putFileAs('', $image, $filename);

        $this->thumbnails[] = $filename;
        $this->uploaded++;
    }
}
