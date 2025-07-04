<?php

namespace App\Livewire\Acp;

use App\Domain\FileStatus;
use App\File;
use App\Livewire\WithGoto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class FileForm extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;
    use WithGoto;

    #[Locked]
    public int|null $id = null;

    public string|null $slug = '';

    #[Validate('required')]
    public string|null $title = '';

    #[Validate('string')]
    public string|null $folder = '';

    #[Validate('required')]
    public FileStatus $status = FileStatus::Published;

    public TemporaryUploadedFile|string|null $upload = null;

    public function mount()
    {
        if ($this->id) {
            $file = File::query()->findOrFail($this->id);

            $this->slug = $file->slug;
            $this->title = $file->title;
            $this->folder = $file->folder;
            $this->status = $file->status;
        }
    }

    public function submit()
    {
        $file = $this->id
            ? File::query()->findOrFail($this->id)
            : new File;

        $this->authorize('create', File::class);
        $this->validate();

        $file->title = $this->title;
        $file->status = $this->status;

        if (!$this->id) {
            $file->slug = $this->slug;
            $file->folder = $this->folder;
        }

        if ($this->upload instanceof TemporaryUploadedFile) {
            $file->size = $this->upload->getSize();
            $file->extension = $this->upload->getClientOriginalExtension();
        }

        $file->save();

        if ($this->upload instanceof TemporaryUploadedFile) {
            \Storage::disk('files')->putFileAs($file->folder, $this->upload, $file->basename());
        }

        return redirect()->to($this->goto ?? to('acp/files'));
    }

    protected function rules()
    {
        return [
            'upload' => [
                Rule::requiredIf(!$this->id),
                'file',
                'nullable',
            ],
            'slug' => [
                'required',
                Rule::unique(File::class, 'slug')
                    ->ignore(File::query()->find($this->id)),
            ],
        ];
    }
}
