<?php namespace App\Http\Livewire\Acp;

use App\City;
use App\Domain\TripStatus;
use App\Trip;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;

class TripForm extends Component
{
    use AuthorizesRequests;

    public int $cityId = 0;
    public int $status;
    public ?int $modelId = null;
    public string $slug;
    public string $dateEnd;
    public string $titleEn = '';
    public string $titleRu = '';
    public string $dateStart;
    public string $metaImage = '';
    public string $metaImageSrc = '';
    public string $metaDescriptionEn = '';
    public string $metaDescriptionRu = '';
    public ?string $goto;

    public function mount(int $modelId = null)
    {
        if ($modelId) {
            $trip = Trip::findOrFail($modelId);

            $this->slug = $trip->slug;
            $this->cityId = $trip->city_id;
            $this->status = $trip->status->jsonSerialize();
            $this->dateEnd = $trip->date_end->toDateTimeString();
            $this->titleEn = $trip->title_en;
            $this->titleRu = $trip->title_ru;
            $this->dateStart = $trip->date_start->toDateTimeString();
            $this->metaImage = $trip->meta_image;
            $this->metaImageSrc = $trip->metaImage();
            $this->metaDescriptionEn = $trip->meta_description_en;
            $this->metaDescriptionRu = $trip->meta_description_ru;
        } else {
            $this->slug = 'city.' . now()->year;
            $this->status = TripStatus::HIDDEN;
            $this->dateEnd = now()->startOfDay()->toDateTimeString();
            $this->dateStart = now()->startOfDay()->toDateTimeString();
        }

        $this->goto = request('goto');
    }

    public function rules()
    {
        $userId = $this->modelId
            ? Trip::findOrFail($this->modelId)->user_id
            : request()->user()->id;

        return [
            'slug' => [
                'bail',
                'required',
                Rule::unique('artists', 'slug'),
                Rule::unique('cities', 'slug'),
                Rule::unique('gigs', 'slug'),
                Rule::unique('trips', 'slug')
                    ->where('user_id', $userId)
                    ->ignore($this->modelId),
            ],
            'cityId' => 'required|integer|min:1',
            'titleEn' => Rule::when($this->modelId, 'required'),
            'titleRu' => Rule::when($this->modelId, 'required'),
            'dateEnd' => 'required|date|after_or_equal:dateStart',
            'dateStart' => 'required|date',
        ];
    }

    public function submit()
    {
        $this->authorize('create', Trip::class);
        $this->validate();

        if ($this->modelId) {
            $this->update();

            return redirect()->to($this->goto ?? '/acp/trips');
        }

        $this->store();

        return redirect()->to($this->goto ?? '/acp/trips');
    }

    public function updatedCityId()
    {
        if ($this->cityId) {
            $city = City::findOrFail($this->cityId);

            $this->slug = "{$city->slug}." . now()->year;
            $this->titleEn = $city->title_en;
            $this->titleRu = $city->title_ru;
        }
    }

    public function updatedMetaImage()
    {
        if ($this->slug && $this->metaImage) {
            $trip = new Trip;
            $trip->slug = $this->slug;
            $trip->meta_image = $this->metaImage;

            $this->metaImageSrc = $trip->metaImage();
        }
    }

    private function fillModel(Trip $trip)
    {
        $trip->slug = $this->slug;
        $trip->status = new TripStatus($this->status);
        $trip->city_id = $this->cityId;
        $trip->date_end = $this->dateEnd;
        $trip->date_start = $this->dateStart;
        $trip->meta_image = $this->metaImage;
        $trip->meta_description_en = $this->metaDescriptionEn;
        $trip->meta_description_ru = $this->metaDescriptionRu;
    }

    private function store()
    {
        $city = City::findOrFail($this->cityId);

        $trip = new Trip;
        $trip->user_id = request()->user()->id;
        $trip->markdown = '';
        $trip->title_en = $city->title_en;
        $trip->title_ru = $city->title_ru;
        $this->fillModel($trip);
        $trip->save();
    }

    private function update()
    {
        $trip = Trip::findOrFail($this->modelId);
        $trip->title_en = $this->titleEn;
        $trip->title_ru = $this->titleRu;
        $this->fillModel($trip);
        $trip->save();
    }
}
