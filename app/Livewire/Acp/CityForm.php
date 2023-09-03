<?php

namespace App\Livewire\Acp;

use App\City;
use App\Livewire\WithCountryIds;
use App\Livewire\WithGoto;
use App\Rules\LifeSlug;
use App\Spatial\Point;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CityForm extends Component
{
    use AuthorizesRequests;
    use WithCountryIds;
    use WithGoto;

    #[Locked]
    public int|null $id = null;

    #[Rule(['required', 'integer', 'min:1'])]
    public int|null $countryId = null;

    #[Rule(['nullable', 'string'])]
    public string|null $lat = null;

    #[Rule(['nullable', 'string'])]
    public string|null $lon = null;

    #[Rule('string')]
    public string|null $iata = '';

    public string|null $slug = '';

    #[Rule('required')]
    public string|null $titleEn = '';

    #[Rule('required')]
    public string|null $titleRu = '';

    public function mount()
    {
        if ($this->id) {
            $city = City::findOrFail($this->id);

            $this->lat = $city->point->lat;
            $this->lon = $city->point->lon;
            $this->iata = $city->iata;
            $this->slug = $city->slug;
            $this->titleEn = $city->title_en;
            $this->titleRu = $city->title_ru;
            $this->countryId = $city->country_id;
        }
    }

    public function rules()
    {
        return [
            'slug' => LifeSlug::rules(City::find($this->id) ?? new City),
        ];
    }

    public function submit()
    {
        $this->authorize('create', City::class);
        $this->validate();

        $city = $this->id
            ? City::findOrFail($this->id)
            : new City;

        $city->iata = $this->iata;
        $city->slug = $this->slug;
        $city->point = $this->lat && $this->lon
            ? new Point($this->lat, $this->lon)
            : null;
        $city->title_en = $this->titleEn;
        $city->title_ru = $this->titleRu;
        $city->country_id = $this->countryId;
        $city->save();

        return redirect()->to($this->goto ?? to('acp/cities'));
    }
}
