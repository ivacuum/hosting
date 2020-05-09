<?php namespace App\Http\Controllers\Acp;

use App\City;
use App\Trip as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Trips extends Controller
{
    protected $sortKey = 'date_start';
    protected $sortableKeys = ['date_start', 'views', 'comments_count', 'photos_count'];
    protected $showWithCount = ['comments', 'photos'];

    public function index()
    {
        $q = request('q');
        $status = request('status');
        $cityId = request('city_id');
        $userId = request('user_id');
        $countryId = request('country_id');

        [$sortKey, $sortDir] = $this->getSortParams();

        $models = Model::with('user')
            ->withCount('comments', 'photos')
            ->when($cityId, fn (Builder $query) => $query->where('city_id', $cityId))
            ->when($countryId,
                fn (Builder $query) => $query->whereHas('city.country',
                    fn (Builder $query) => $query->where('country_id', $countryId)))
            ->when($userId, fn (Builder $query) => $query->where('user_id', $userId))
            ->unless(null === $status, fn (Builder $query) => $query->where('status', $status))
            ->when($q,
                fn (Builder $query) => $query->where('id', $q)
                    ->orWhere(Model::titleField(), 'LIKE', "%{$q}%")
                    ->orWhere('slug', 'LIKE', "%{$q}%"))
            ->orderBy($sortKey, $sortDir)
            ->paginate(50);

        return view($this->view, [
            'models' => $models,
        ]);
    }

    protected function newModelDefaults($model)
    {
        /** @var Model $model */
        $model->slug = 'city.' . now()->year;
        $model->status = Model::STATUS_HIDDEN;
        $model->date_end = now()->startOfDay();
        $model->date_start = now()->startOfDay();

        return $model;
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
                    ->where('user_id', $model->user_id ?? request()->user()->id)
                    ->ignore($model->id ?? null),
            ],
            'city_id' => 'required|integer|min:1',
            'title_ru' => null === $model ? '' : 'required',
            'title_en' => null === $model ? '' : 'required',
            'date_end' => 'required|date|after_or_equal:date_start',
            'date_start' => 'required|date',
        ];
    }

    protected function storeModel()
    {
        /** @var City $city */
        $city = City::findOrFail(request('city_id'));

        $data = $this->requestDataForModel();
        $data['user_id'] = request()->user()->id;
        $data['title_ru'] = $city->title_ru;
        $data['title_en'] = $city->title_en;
        $data['markdown'] = '';

        $model = Model::create($data);

        if (\App::isLocal()) {
            $model->createStoryFile();
        }

        return $model;
    }
}
