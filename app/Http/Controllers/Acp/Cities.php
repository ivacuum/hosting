<?php namespace App\Http\Controllers\Acp;

use App\City as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;
use Ivacuum\Generic\Services\GoogleGeocoder;

class Cities extends Controller
{
    protected $sort_dir = 'asc';
    protected $sort_key = 'title';
    protected $sortable_keys = ['title', 'trips_count', 'views'];
    protected $show_with_count = ['trips'];

    public function index()
    {
        $country_id = request('country_id');

        [$sort_key, $sort_dir] = $this->getSortParams();

        $sort_key = $sort_key === 'title' ? Model::titleField() : $sort_key;

        $models = Model::with('country')
            ->withCount('trips')
            ->orderBy($sort_key, $sort_dir)
            ->when($country_id, function (Builder $query) use ($country_id) {
                return $query->where('country_id', $country_id);
            })
            ->paginate();

        return view($this->view, compact('models'));
    }

    public function updateGeo($id, GoogleGeocoder $geocoder)
    {
        /* @var Model $model */
        $model = $this->getModel($id);

        $geo = $geocoder->geocode("{$model->title}, {$model->country->title}")[0];

        $model->update([
            'lat' => $geo['lat'],
            'lon' => $geo['lon'],
        ]);

        return back()->with('message', "Геоданные обновлены: [{$model->lat} {$model->lon}]");
    }

    protected function redirectAfterStore($model)
    {
        return redirect(path("{$this->class}@show", $model));
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
