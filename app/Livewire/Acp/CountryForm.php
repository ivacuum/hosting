<?php

namespace App\Livewire\Acp;

use App\Country;
use App\Livewire\WithGoto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Component;

class CountryForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    #[Locked]
    public int|null $id = null;

    public string|null $slug = '';

    #[\Livewire\Attributes\Rule('string')]
    public string|null $emoji = '';

    #[\Livewire\Attributes\Rule('required')]
    public string|null $titleEn = '';

    #[\Livewire\Attributes\Rule('required')]
    public string|null $titleRu = '';

    public function mount()
    {
        if ($this->id) {
            $country = Country::findOrFail($this->id);

            $this->slug = $country->slug;
            $this->emoji = $country->emoji;
            $this->titleEn = $country->title_en;
            $this->titleRu = $country->title_ru;
        }
    }

    public function rules()
    {
        return [
            'slug' => [
                'required',
                Rule::unique(Country::class, 'slug')
                    ->ignore(Country::find($this->id)),
            ],
        ];
    }

    public function submit()
    {
        $this->authorize('create', Country::class);
        $this->validate();
        $this->store();

        return redirect()->to($this->goto ?? to('acp/countries'));
    }

    private function store()
    {
        $country = $this->id
            ? Country::findOrFail($this->id)
            : new Country;

        $country->slug = $this->slug;
        $country->emoji = $this->emoji;
        $country->title_en = $this->titleEn;
        $country->title_ru = $this->titleRu;
        $country->save();
    }
}
