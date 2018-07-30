<?php namespace App\Http\Controllers\Acp;

use App\City as Model;
use App\Country;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;
use Ivacuum\Generic\Services\GoogleGeocoder;

class Cities extends Controller
{
    protected $api_only = true;
    protected $sort_dir = 'asc';
    protected $sort_key = 'title';
    protected $sortable_keys = ['title', 'trips_count', 'views'];
    protected $show_with_count = ['trips'];
    protected $reactive_fields = ['country_id', 'title_en', 'title_ru', 'lat', 'lon'];

    public function index()
    {
        $country_id = request('country_id');

        [$sort_key, $sort_dir] = $this->getSortParams();

        $sort_key = $sort_key === 'title' ? Model::titleField() : $sort_key;

        $models = Model::query()
            ->with('country')
            ->withCount('trips')
            ->orderBy($sort_key, $sort_dir)
            ->when($country_id, function (Builder $query) use ($country_id) {
                return $query->where('country_id', $country_id);
            })
            ->paginate()
            ->withPath(path("{$this->class}@index"));

        return $this->modelResourceCollection($models);
    }

    public function geodata(GoogleGeocoder $geocoder)
    {
        $q = request('q');

        $geo = $geocoder->geocode($q)[0];

        return [
            'lat' => str_replace(',', '.', $geo['lat']),
            'lon' => str_replace(',', '.', $geo['lon']),
            'address' => $geo['address'],
        ];
    }

    protected function appendToCreateAndEditResponse($model): array
    {
        return ['countries' => Country::forInputSelectJs()];
    }

    /**
     * @param  Model|null $model
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
