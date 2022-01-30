<?php namespace App\Http\Livewire\Acp;

use App\Photo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;

class PhotoEditForm extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public $tags;
    public $image;
    public ?int $modelId = null;
    public ?string $goto;

    public function mount(int $modelId)
    {
        $photo = Photo::findOrFail($modelId);

        $this->goto = request('goto');
        $this->tags = $photo->tags->modelKeys();
        $this->image = $photo->originalUrl();
    }

    public function rules()
    {
        return [
            'tags' => 'array',
        ];
    }

    public function submit()
    {
        $this->authorize('update', Photo::class);
        $this->validate();

        $photo = Photo::findOrFail($this->modelId);

        $photo->tags()->sync($this->tags);

        return redirect()->to($this->goto ?? '/acp/trips');
    }
}
