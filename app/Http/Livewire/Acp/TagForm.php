<?php namespace App\Http\Livewire\Acp;

use App\Http\Livewire\WithGoto;
use App\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;

class TagForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    public Tag $tag;

    public function rules()
    {
        return [
            'tag.title_ru' => [
                'required',
                Rule::unique(Tag::class, 'title_ru')->ignore($this->tag),
            ],
            'tag.title_en' => [
                'required',
                Rule::unique(Tag::class, 'title_en')->ignore($this->tag),
            ],
        ];
    }

    public function submit()
    {
        $this->authorize('create', $this->tag);
        $this->validate();
        $this->tag->save();

        return redirect()->to($this->goto ?? to('acp/tags'));
    }
}
