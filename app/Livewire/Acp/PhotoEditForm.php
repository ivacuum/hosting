<?php

namespace App\Livewire\Acp;

use App\Domain\Life\Models\Photo;
use App\Livewire\WithGoto;
use Livewire\Attributes\Authorize;
use Livewire\Component;
use Livewire\WithFileUploads;

class PhotoEditForm extends Component
{
    use WithFileUploads;
    use WithGoto;

    public $tags;
    public Photo $photo;

    public function mount()
    {
        $this->tags = $this->photo->tags->modelKeys();
    }

    #[Authorize('update', 'photo')]
    public function submit()
    {
        $this->validate();

        $this->photo->tags()->sync($this->tags);

        return redirect()->to($this->goto ?? to('acp/photos'));
    }

    protected function rules()
    {
        return [
            'tags' => 'array',
        ];
    }
}
