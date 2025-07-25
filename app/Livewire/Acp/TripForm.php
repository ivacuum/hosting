<?php

namespace App\Livewire\Acp;

use App\City;
use App\Domain\TripStatus;
use App\Livewire\WithCityIds;
use App\Livewire\WithGoto;
use App\Rules\LifeSlug;
use App\Trip;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Locked;
use Livewire\Component;

class TripForm extends Component
{
    use AuthorizesRequests;
    use WithCityIds;
    use WithGoto;

    #[Locked]
    public int|null $id = null;

    public int|null $cityId = null;
    public string|null $slug = '';
    public string|null $titleEn = '';
    public string|null $titleRu = '';
    public string|null $metaImage = '';
    public string|null $metaTitleEn = '';
    public string|null $metaTitleRu = '';
    public string|null $metaDescriptionEn = '';
    public string|null $metaDescriptionRu = '';
    public TripStatus $status = TripStatus::Published;
    public CarbonImmutable|string|null $dateEnd = '';
    public CarbonImmutable|string|null $dateStart = '';

    public function metaImageSrc()
    {
        $trip = new Trip;
        $trip->slug = $this->slug;
        $trip->meta_image = $this->metaImage;

        return $trip->metaImage();
    }

    public function mount()
    {
        if ($this->id) {
            $trip = Trip::query()->findOrFail($this->id);

            $this->slug = $trip->slug;
            $this->cityId = $trip->city_id;
            $this->status = $trip->status;
            $this->dateEnd = $trip->date_end->toDateTimeLocalString();
            $this->titleEn = $trip->title_en;
            $this->titleRu = $trip->title_ru;
            $this->dateStart = $trip->date_start->toDateTimeLocalString();
            $this->metaImage = $trip->meta_image;
            $this->metaTitleEn = $trip->meta_title_en;
            $this->metaTitleRu = $trip->meta_title_ru;
            $this->metaDescriptionEn = $trip->meta_description_en;
            $this->metaDescriptionRu = $trip->meta_description_ru;
        } else {
            $this->slug = 'city.' . now()->year;
            $this->dateEnd = today()->toDateTimeLocalString();
            $this->dateStart = today()->toDateTimeLocalString();
        }
    }

    public function submit()
    {
        $this->authorize('create', Trip::class);
        $this->validate();
        $this->store();

        return redirect()->to($this->goto ?? to('acp/trips'));
    }

    public function updatedCityId()
    {
        $city = City::query()->find($this->cityId);

        if ($city) {
            $this->slug = "{$city->slug}." . now()->year;
            $this->titleEn = $city->title_en;
            $this->titleRu = $city->title_ru;
        }
    }

    protected function rules()
    {
        return [
            'slug' => LifeSlug::rules(Trip::query()->find($this->id) ?? new Trip),
            'cityId' => 'required|integer|min:1',
            'status' => new Enum(TripStatus::class),
            'dateEnd' => 'required|date|after_or_equal:dateStart',
            'titleEn' => Rule::requiredIf($this->id),
            'titleRu' => Rule::requiredIf($this->id),
            'dateStart' => 'required|date',
            'metaImage' => 'string',
            'metaTitleEn' => 'string',
            'metaTitleRu' => 'string',
            'metaDescriptionEn' => 'string',
            'metaDescriptionRu' => 'string',
        ];
    }

    private function store()
    {
        $trip = $this->id
            ? Trip::query()->findOrFail($this->id)
            : new Trip;

        if (!$this->id) {
            $trip->user_id = request()->user()->id;
        }

        $trip->slug = $this->slug;
        $trip->city_id = $this->cityId;
        $trip->status = $this->status;
        $trip->date_end = $this->dateEnd;
        $trip->title_en = $this->titleEn;
        $trip->title_ru = $this->titleRu;
        $trip->date_start = $this->dateStart;
        $trip->meta_image = $this->metaImage;
        $trip->meta_title_en = $this->metaTitleEn;
        $trip->meta_title_ru = $this->metaTitleRu;
        $trip->meta_description_en = $this->metaDescriptionEn;
        $trip->meta_description_ru = $this->metaDescriptionRu;
        $trip->save();
    }
}
