<?php

namespace App\Livewire\Acp;

use App\Domain\Life\Models\Tag;
use App\Livewire\WithGoto;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Authorize;
use Livewire\Attributes\Locked;
use Livewire\Component;

class TagForm extends Component
{
    use WithGoto;

    #[Locked]
    public int|null $id = null;

    public string|null $titleEn = '';
    public string|null $titleRu = '';

    public function mount()
    {
        if ($this->id) {
            $tag = Tag::query()->findOrFail($this->id);

            $this->titleEn = $tag->title_en;
            $this->titleRu = $tag->title_ru;
        }
    }

    #[Authorize('create', Tag::class)]
    public function submit()
    {
        $this->validate();
        $this->store();

        return redirect()->to($this->goto ?? to('acp/tags'));
    }

    protected function rules()
    {
        $tag = Tag::query()->find($this->id);

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

    private function store()
    {
        $tag = $this->id
            ? Tag::query()->findOrFail($this->id)
            : new Tag;

        $tag->title_en = $this->titleEn;
        $tag->title_ru = $this->titleRu;
        $tag->save();
    }
}
