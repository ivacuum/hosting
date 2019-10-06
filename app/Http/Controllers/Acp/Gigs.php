<?php namespace App\Http\Controllers\Acp;

use App\Artist;
use App\City;
use App\Gig as Model;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Gigs extends Controller
{
    protected $apiOnly = true;
    protected $sortKey = 'date';
    protected $sortableKeys = ['date', 'views'];

    public function index()
    {
        [$sortKey, $sortDir] = $this->getSortParams();

        $models = Model::orderBy($sortKey, $sortDir)
            ->paginate(500)
            ->withPath(path([self::class, 'index']));

        return $this->modelResourceCollection($models);
    }

    protected function appendToCreateAndEditResponse($model): array
    {
        return [
            'cities' => City::forInputSelectJs(),
            'artists' => Artist::forInputSelectJs(),
        ];
    }

    protected function newModelDefaults($model)
    {
        /** @var Model $model */
        $model->date = now()->startOfDay();
        $model->slug = 'artist.'.now()->year;
        $model->status = Model::STATUS_HIDDEN;

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
                    ->where('user_id', 1)
                    ->ignore($model->id ?? null),
            ],
            'date' => 'required|date',
            'city_id' => 'required|integer|min:1',
            'title_ru' => 'required',
            'title_en' => 'required',
            'artist_id' => 'required|integer|min:1',
        ];
    }
}
