<?php namespace App\Http\Controllers\Acp;

use App\City as Model;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;
use Ivacuum\Generic\Services\GoogleGeocoder;

class Cities extends Controller
{
    protected $show_with_count = ['trips'];

    public function index()
    {
        $country_id = $this->request->input('country_id');

        $models = Model::with('country')
            ->withCount('trips')
            ->orderBy(Model::titleField());

        if ($country_id) {
            $models = $models->where('country_id', $country_id);
        }

        $models = $models->get();

        return view($this->view, compact('models'));
    }

    public function updateGeo($id, GoogleGeocoder $geocoder)
    {
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
                Rule::unique('trips', 'slug')->ignore($model->id ?? null),
            ],
            'title_ru' => 'required',
            'title_en' => 'required',
            'country_id' => 'required|integer|min:1',
        ];
    }
}
