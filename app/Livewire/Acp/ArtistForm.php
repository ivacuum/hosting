<?php

namespace App\Livewire\Acp;

use App\Domain\Life\Models\Artist;
use App\Domain\Life\Rule\LifeSlug;
use App\Livewire\WithGoto;
use Livewire\Attributes\Authorize;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ArtistForm extends Component
{
    use WithGoto;

    #[Locked]
    public int|null $id = null;

    public string|null $slug = '';

    #[Validate('required')]
    public string|null $title = '';

    public function mount()
    {
        if ($this->id) {
            $artist = Artist::query()->findOrFail($this->id);

            $this->slug = $artist->slug;
            $this->title = $artist->title;
        }
    }

    #[Authorize('create', Artist::class)]
    public function submit()
    {
        $this->validate();
        $this->store();

        return redirect()->to($this->goto ?? to('acp/artists'));
    }

    protected function rules()
    {
        return [
            'slug' => LifeSlug::rules(Artist::query()->find($this->id) ?? new Artist),
        ];
    }

    private function store()
    {
        $artist = $this->id
            ? Artist::query()->findOrFail($this->id)
            : new Artist;

        $artist->slug = $this->slug;
        $artist->title = $this->title;
        $artist->save();
    }
}
