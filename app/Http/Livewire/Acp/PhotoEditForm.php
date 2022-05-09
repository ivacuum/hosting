<?php namespace App\Http\Livewire\Acp;

use App\Http\Livewire\WithGoto;
use App\Photo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;

class PhotoEditForm extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;
    use WithGoto;

    public $tags;
    public Photo $photo;

    public function mount()
    {
        $this->tags = $this->photo->tags->modelKeys();
    }

    public function rules()
    {
        return [
            'tags' => 'array',
        ];
    }

    public function submit()
    {
        $this->authorize('update', $this->photo);
        $this->validate();

        $this->photo->tags()->sync($this->tags);

        return redirect()->to($this->goto ?? to('acp/photos'));
    }
}
