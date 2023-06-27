<?php

namespace App\Http\Livewire\Acp;

use App\Country;
use App\Http\Livewire\WithGoto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CountryForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    public Country $country;

    public function rules()
    {
        return [
            'country.slug' => [
                'required',
                Rule::unique(Country::class, 'slug')->ignore($this->country, 'slug'),
            ],
            'country.emoji' => 'string',
            'country.title_en' => 'required',
            'country.title_ru' => 'required',
        ];
    }

    public function submit()
    {
        $this->authorize('create', $this->country);
        $this->validate();
        $this->country->save();

        return redirect()->to($this->goto ?? to('acp/countries'));
    }
}
