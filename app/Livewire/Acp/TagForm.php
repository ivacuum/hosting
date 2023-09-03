<?php

namespace App\Livewire\Acp;

use App\Livewire\WithGoto;
use App\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Component;

class TagForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    #[Locked]
    public int|null $id = null;

    public string|null $titleEn = '';
    public string|null $titleRu = '';

    public function mount()
    {
        if ($this->id) {
            $tag = Tag::findOrFail($this->id);

            $this->titleEn = $tag->title_en;
            $this->titleRu = $tag->title_ru;
        }
    }

    public function rules()
    {
        $tag = Tag::find($this->id);

        return [
            'titleRu' => [
                'required',
                Rule::unique(Tag::class, 'title_ru')->ignore($tag),
            ],
            'titleEn' => [
                'required',
                Rule::unique(Tag::class, 'title_en')->ignore($tag),
            ],
        ];
    }

    public function submit()
    {
        $this->authorize('create', Tag::class);
        $this->validate();
        $this->store();

        return redirect()->to($this->goto ?? to('acp/tags'));
    }

    private function store()
    {
        $tag = $this->id
            ? Tag::findOrFail($this->id)
            : new Tag;

        $tag->title_en = $this->titleEn;
        $tag->title_ru = $this->titleRu;
        $tag->save();
    }
}
