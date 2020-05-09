<?php namespace App\Http\Controllers\Acp;

use App\City as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;
use Ivacuum\Generic\Services\GoogleGeocoder;

class Cities extends Controller
{
    protected $sortDir = 'asc';
    protected $sortKey = 'title';
    protected $sortableKeys = ['title', 'trips_count', 'views'];
    protected $showWithCount = ['trips'];
    protected $reactiveFields = ['country_id', 'title_en', 'title_ru', 'lat', 'lon'];

    public function index()
    {
        $countryId = request('country_id');

        [$sortKey, $sortDir] = $this->getSortParams();

        $sortKey = $sortKey === 'title' ? Model::titleField() : $sortKey;

        $models = Model::query()
            ->with('country')
            ->withCount('trips')
            ->orderBy($sortKey, $sortDir)
            ->when($countryId, fn (Builder $query) => $query->where('country_id', $countryId))
            ->paginate();

        return view($this->view, [
            'models' => $models,
        ]);
    }

    public function geodata(GoogleGeocoder $geocoder)
    {
        $q = request('q');

        $geo = $geocoder->geocode($q)[0];

        return [
            'lat' => $geo['lat'],
            'lon' => $geo['lon'],
            'address' => $geo['address'],
        ];
    }

    /**
     * @param Model|null $model
     * @return array
     */
    protected function rules($model = null)
    {
        return [
            'slug' => [
                'bail',
                'required',
                Rule::unique('artists', 'slug')->ignore($model->id ?? null),
                Rule::unique('cities', 'slug')->ignore($model->id ?? null),
                Rule::unique('gigs', 'slug')->ignore($model->id ?? null),
                Rule::unique('trips', 'slug')
                    ->where('user_id', 1)
                    ->ignore($model->id ?? null),
            ],
            'title_ru' => 'required',
            'title_en' => 'required',
            'country_id' => 'required|integer|min:1',
        ];
    }
}
