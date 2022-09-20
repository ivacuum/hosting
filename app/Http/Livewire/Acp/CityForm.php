<?php namespace App\Http\Livewire\Acp;

use App\City;
use App\Http\Livewire\WithCountryIds;
use App\Http\Livewire\WithGoto;
use App\Rules\LifeSlug;
use App\Spatial\Point;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class CityForm extends Component
{
    use AuthorizesRequests;
    use WithCountryIds;
    use WithGoto;

    public City $city;

    public function rules()
    {
        return [
            'city.lat' => 'string',
            'city.lon' => 'string',
            'city.iata' => 'string',
            'city.slug' => LifeSlug::rules($this->city),
            'city.title_en' => 'required',
            'city.title_ru' => 'required',
            'city.country_id' => 'required|integer|min:1',
        ];
    }

    public function submit()
    {
        $this->authorize('create', $this->city);
        $this->validate();
        $this->city->point = $this->city->lat
            ? new Point($this->city->lat, $this->city->lon)
            : null;
        $this->city->save();

        return redirect()->to($this->goto ?? to('acp/cities'));
    }
}
