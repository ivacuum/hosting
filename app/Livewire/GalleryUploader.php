<?php

namespace App\Livewire;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class GalleryUploader extends Component
{
    use WithFileUploads;

    /** @var \Livewire\Features\SupportFileUploads\TemporaryUploadedFile[] */
    public $files;
    public array $links;

    public function linksWithTags()
    {
        return collect($this->links)
            ->map(static fn ($link) => "[img]{$link['original']}[/img]")
            ->implode(' ');
    }

    public function linksWithoutTags()
    {
        return collect($this->links)
            ->pluck('original')
            ->implode("\n");
    }

    public function updatedFiles(): void
    {
        $this->validate();

        foreach ($this->files as $file) {
            $image = Image::newFromFile($file, Auth::user()->id);
            $image->siteThumbnail($file);
            $image->upload($file);
            $image->save();

            event(new \App\Events\Stats\GalleryImageUploaded);

            $this->links[] = [
                'original' => $image->originalUrl(),
                'thumbnail' => $image->thumbnailUrl(),
            ];
        }
    }

    protected function messages(): array
    {
        return [
            'files.*.dimensions' => __('Изображение должно быть не больше :max_width×:max_height пикселей. Уменьшите его и попробуйте снова.'),
        ];
    }

    protected function rules(): array
    {
        return [
            'files' => ['array', 'max:10'],
            'files.*' => [
                'required',
                'image',
                'mimetypes:image/gif,image/jpeg,image/png',
                'max:6144',
                'dimensions:max_width=8000,max_height=8000',
            ],
        ];
    }
}
