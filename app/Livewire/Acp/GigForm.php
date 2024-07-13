<?php

namespace App\Livewire\Acp;

use App\Artist;
use App\Domain\GigStatus;
use App\Gig;
use App\Livewire\WithArtistIds;
use App\Livewire\WithCityIds;
use App\Livewire\WithGoto;
use App\Rules\LifeSlug;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

class GigForm extends Component
{
    use AuthorizesRequests;
    use WithArtistIds;
    use WithCityIds;
    use WithGoto;

    #[Locked]
    public int|null $id = null;

    public int|null $cityId = null;
    public int|null $artistId = null;
    public string|null $slug = '';

    #[Validate('required')]
    public string|null $titleEn = '';

    #[Validate('required')]
    public string|null $titleRu = '';

    public string|null $metaImage = '';
    public string|null $metaDescriptionEn = '';
    public string|null $metaDescriptionRu = '';
    public GigStatus|string|null $status = GigStatus::Published;
    public CarbonImmutable|string|null $date = '';

    public function mount()
    {
        if ($this->id) {
            $gig = Gig::query()->findOrFail($this->id);

            $this->date = $gig->date->toDateTimeLocalString();
            $this->slug = $gig->slug;
            $this->cityId = $gig->city_id;
            $this->status = $gig->status;
            $this->titleEn = $gig->title_en;
            $this->titleRu = $gig->title_ru;
            $this->artistId = $gig->artist_id;
            $this->metaImage = $gig->meta_image;
            $this->metaDescriptionEn = $gig->meta_description_en;
            $this->metaDescriptionRu = $gig->meta_description_ru;
        } else {
            $this->date = now()->startOfDay()->toDateTimeLocalString();
            $this->slug = 'artist.' . now()->year;
        }
    }

    public function rules()
    {
        return [
            'date' => 'required|date',
            'slug' => LifeSlug::rules(Gig::query()->find($this->id) ?? new Gig),
            'cityId' => 'required|integer|min:1',
            'status' => 'required',
            'artistId' => 'required|integer|min:1',
            'metaImage' => 'string',
            'metaDescriptionEn' => 'string',
            'metaDescriptionRu' => 'string',
        ];
    }

    public function submit()
    {
        $this->authorize('create', Gig::class);
        $this->validate();
        $this->store();

        return redirect()->to($this->goto ?? to('acp/gigs'));
    }

    public function updatedArtistId()
    {
        $artist = Artist::query()->find($this->artistId);

        if ($artist) {
            $this->slug = "{$artist->slug}." . now()->year;
            $this->titleEn = $artist->title;
            $this->titleRu = $artist->title;
        }
    }

    private function store()
    {
        $gig = $this->id
            ? Gig::query()->findOrFail($this->id)
            : new Gig;

        $gig->date = $this->date;
        $gig->slug = $this->slug;
        $gig->status = $this->status;
        $gig->city_id = $this->cityId;
        $gig->title_en = $this->titleEn;
        $gig->title_ru = $this->titleRu;
        $gig->artist_id = $this->artistId;
        $gig->meta_image = $this->metaImage;
        $gig->meta_description_en = $this->metaDescriptionEn;
        $gig->meta_description_ru = $this->metaDescriptionRu;
        $gig->save();
    }
}
