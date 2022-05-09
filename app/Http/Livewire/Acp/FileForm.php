<?php namespace App\Http\Livewire\Acp;

use App\File;
use App\Http\Livewire\WithGoto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class FileForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;
    use WithFileUploads;

    public File $file;
    public TemporaryUploadedFile|string|null $upload = null;

    public function rules()
    {
        return [
            'upload' => [
                Rule::when(!$this->file->exists, 'required'),
                'file',
                'nullable',
            ],
            'file.slug' => [
                'required',
                Rule::unique(File::class, 'slug')->ignore($this->file),
            ],
            'file.title' => 'required',
            'file.folder' => 'string',
            'file.status' => 'required',
        ];
    }

    public function submit()
    {
        $this->authorize('create', $this->file);
        $this->validate();

        if ($this->upload instanceof TemporaryUploadedFile) {
            $this->file->size = $this->upload->getSize();
            $this->file->extension = $this->upload->getClientOriginalExtension();
        }

        $this->file->save();

        if ($this->upload instanceof TemporaryUploadedFile) {
            \Storage::disk('files')->putFileAs($this->file->folder, $this->upload, $this->file->basename());
        }

        return redirect()->to($this->goto ?? to('acp/files'));
    }
}
