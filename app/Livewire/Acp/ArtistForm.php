<?php

namespace App\Livewire\Acp;

use App\Artist;
use App\Livewire\WithGoto;
use App\Rules\LifeSlug;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ArtistForm extends Component
{
    use AuthorizesRequests;
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

    public function submit()
    {
        $this->authorize('create', Artist::class);
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
