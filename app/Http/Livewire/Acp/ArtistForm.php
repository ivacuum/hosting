<?php namespace App\Http\Livewire\Acp;

use App\Artist;
use App\Http\Livewire\WithGoto;
use App\Rules\LifeSlug;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ArtistForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    public Artist $artist;

    public function rules()
    {
        return [
            'artist.slug' => LifeSlug::rules($this->artist),
            'artist.title' => 'required',
        ];
    }

    public function submit()
    {
        $this->authorize('create', $this->artist);
        $this->validate();
        $this->artist->save();

        return redirect()->to($this->goto ?? to('acp/artists'));
    }
}
