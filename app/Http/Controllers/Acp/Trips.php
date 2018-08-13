<?php namespace App\Http\Controllers\Acp;

use App\City;
use App\Trip as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Trips extends Controller
{
    protected $api_only = true;
    protected $sort_key = 'date_start';
    protected $sortable_keys = ['date_start', 'views', 'comments_count', 'photos_count'];
    protected $show_with_count = ['comments', 'photos'];

    public function index()
    {
        $q = request('q');
        $status = request('status');
        $city_id = request('city_id');
        $user_id = request('user_id');
        $country_id = request('country_id');

        [$sort_key, $sort_dir] = $this->getSortParams();

        $models = Model::with('user')
            ->withCount('comments', 'photos')
            ->when($city_id, function (Builder $query) use ($city_id) {
                return $query->where('city_id', $city_id);
            })
            ->when($country_id, function (Builder $query) use ($country_id) {
                return $query->whereHas('city.country', function (Builder $query) use ($country_id) {
                    $query->where('country_id', $country_id);
                });
            })
            ->when($user_id, function (Builder $query) use ($user_id) {
                return $query->where('user_id', $user_id);
            })
            ->unless(null === $status, function (Builder $query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($q, function (Builder $query) use ($q) {
                return $query->where('id', $q)
                    ->orWhere(Model::titleField(), 'LIKE', "%{$q}%")
                    ->orWhere('slug', 'LIKE', "%{$q}%");
            })
            ->orderBy($sort_key, $sort_dir)
            ->paginate(50)
            ->withPath(path("{$this->class}@index"));

        return $this->modelResourceCollection($models);
    }

    protected function appendToCreateAndEditResponse($model): array
    {
        return ['cities' => City::forInputSelectJs()];
    }

    protected function newModelDefaults($model)
    {
        /* @var Model $model */
        $model->slug = 'city.'.now()->year;
        $model->status = Model::STATUS_HIDDEN;
        $model->date_end = now()->startOfDay();
        $model->date_start = now()->startOfDay();

        return $model;
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
                    ->where('user_id', $model->user_id ?? request()->user()->id)
                    ->ignore($model->id ?? null),
            ],
            'city_id' => 'required|integer|min:1',
            'title_ru' => null === $model ? '' : 'required',
            'title_en' => null === $model ? '' : 'required',
            'date_end' => 'required|date',
            'date_start' => 'required|date',
        ];
    }

    protected function storeModel()
    {
        /* @var City $city */
        $city = City::findOrFail(request('city_id'));

        $data = $this->requestDataForModel();
        $data['user_id'] = request()->user()->id;
        $data['title_ru'] = $city->title_ru;
        $data['title_en'] = $city->title_en;

        $model = Model::create($data);

        if (\App::isLocal()) {
            $model->createStoryFile();
        }

        return $model;
    }
}
