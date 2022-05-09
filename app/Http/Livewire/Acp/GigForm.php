<?php namespace App\Http\Livewire\Acp;

use App\Gig;
use App\Http\Livewire\WithArtistIds;
use App\Http\Livewire\WithCityIds;
use App\Http\Livewire\WithGoto;
use App\Rules\LifeSlug;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class GigForm extends Component
{
    use AuthorizesRequests;
    use WithArtistIds;
    use WithCityIds;
    use WithGoto;

    public Gig $gig;

    public function mount()
    {
        if (!$this->gig->exists) {
            $this->gig->date = now()->startOfDay();
            $this->gig->slug = 'artist.' . now()->year;
        }
    }

    public function rules()
    {
        return [
            'gig.slug' => LifeSlug::rules($this->gig),
            'gig.date' => 'required|date',
            'gig.status' => 'required',
            'gig.city_id' => 'required|integer|min:1',
            'gig.title_ru' => 'required',
            'gig.title_en' => 'required',
            'gig.artist_id' => 'required|integer|min:1',
            'gig.meta_image' => 'string',
            'gig.meta_description_en' => 'string',
            'gig.meta_description_ru' => 'string',
        ];
    }

    public function submit()
    {
        $this->authorize('create', Gig::class);
        $this->validate();
        $this->gig->save();

        return redirect()->to($this->goto ?? to('acp/gigs'));
    }

    public function updatedGigArtistId()
    {
        $this->gig->load('artist');

        if ($this->gig->artist) {
            $this->gig->slug = "{$this->gig->artist->slug}." . now()->year;
            $this->gig->title_en = $this->gig->artist->title;
            $this->gig->title_ru = $this->gig->artist->title;
        }
    }
}
