<?php namespace App\Http\Livewire\Acp;

use App\Domain\TripStatus;
use App\Http\Livewire\WithCityIds;
use App\Http\Livewire\WithGoto;
use App\Rules\LifeSlug;
use App\Trip;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

class TripForm extends Component
{
    use AuthorizesRequests;
    use WithCityIds;
    use WithGoto;

    public Trip $trip;

    public function mount()
    {
        if (!$this->trip->exists) {
            $this->trip->slug = 'city.' . now()->year;
            $this->trip->date_end = now()->startOfDay();
            $this->trip->date_start = now()->startOfDay();
        }
    }

    public function rules()
    {
        return [
            'trip.slug' => LifeSlug::rules($this->trip),
            'trip.status' => new Enum(TripStatus::class),
            'trip.city_id' => 'required|integer|min:1',
            'trip.date_end' => 'required|date|after_or_equal:dateStart',
            'trip.title_en' => Rule::when($this->trip->exists, 'required'),
            'trip.title_ru' => Rule::when($this->trip->exists, 'required'),
            'trip.date_start' => 'required|date',
            'trip.meta_image' => 'string',
            'trip.meta_title_en' => 'string',
            'trip.meta_title_ru' => 'string',
            'trip.meta_description_en' => 'string',
            'trip.meta_description_ru' => 'string',
        ];
    }

    public function submit()
    {
        $this->authorize('create', $this->trip);
        $this->validate();
        $this->store();

        return redirect()->to($this->goto ?? to('acp/trips'));
    }

    public function updatedTripCityId()
    {
        $this->trip->load('city');

        if ($this->trip->city) {
            $this->trip->slug = "{$this->trip->city->slug}." . now()->year;
            $this->trip->title_en = $this->trip->city->title_en;
            $this->trip->title_ru = $this->trip->city->title_ru;
        }
    }

    private function store()
    {
        if (!$this->trip->exists) {
            $this->trip->user_id = request()->user()->id;
        }

        $this->trip->save();
    }
}
