<?php

namespace App\Livewire;

use App\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class GalleryUploader extends Component
{
    use WithFileUploads;

    /** @var \Livewire\Features\SupportFileUploads\TemporaryUploadedFile[] */
    public $files;
    public array $links;
    public string $randomId;

    public function linksWithTags()
    {
        return collect($this->links)
            ->map(fn ($link) => "[img]{$link['original']}[/img]")
            ->implode(' ');
    }

    public function linksWithoutTags()
    {
        return collect($this->links)
            ->pluck('original')
            ->implode("\n");
    }

    public function mount()
    {
        $this->resetChosenFile();
    }

    public function rules()
    {
        return [
            'files.*' => [
                'required',
                'image',
                'mimetypes:image/gif,image/jpeg,image/png',
                'max:6144',
            ],
        ];
    }

    public function updatedFiles()
    {
        $this->validate();

        foreach ($this->files as $file) {
            $image = Image::newFromFile($file, \Auth::user()->id);
            $image->siteThumbnail($file);
            $image->upload($file);
            $image->save();

            event(new \App\Events\Stats\GalleryImageUploaded);

            $this->links[] = [
                'original' => $image->originalUrl(),
                'thumbnail' => $image->thumbnailUrl(),
            ];
        }

        $this->resetChosenFile();
    }

    private function resetChosenFile()
    {
        $this->randomId = \Str::random();
    }
}
