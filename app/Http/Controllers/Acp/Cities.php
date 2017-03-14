<?php namespace App\Http\Controllers\Acp;

use App\City as Model;
use App\Services\GoogleGeocoder;
use Illuminate\Validation\Rule;

class Cities extends Controller
{
    public function index()
    {
        $country_id = $this->request->input('country_id');

        $models = Model::with('country')->orderBy(Model::titleField());

        if ($country_id) {
            $models = $models->where('country_id', $country_id);
        }

        $models = $models->get();

        return view($this->view, compact('models'));
    }

    public function create()
    {
        return view('acp.create');
    }

    public function destroy(Model $model)
    {
        $model->delete();

        return [
            'status'   => 'OK',
            'redirect' => action("{$this->class}@index"),
        ];
    }

    public function edit(Model $model)
    {
        return view('acp.edit', compact('model'));
    }

    public function show(Model $model)
    {
        return view('acp.show', compact('model'));
    }

    public function store()
    {
        $this->validate($this->request, $this->rules());

        $model = Model::create($this->request->all());

        return redirect()->action("{$this->class}@show", $model);
    }

    public function update(Model $model)
    {
        $this->validate($this->request, $this->rules($model));

        $model->update($this->request->all());

        return $this->redirectAfterUpdate($model);
    }

    public function updateGeo(Model $model, GoogleGeocoder $geocoder)
    {
        $geo = $geocoder->geocode("{$model->title}, {$model->country->title}")[0];

        $model->update([
            'lat' => $geo['lat'],
            'lon' => $geo['lon'],
        ]);

        return back()->with('message', "Геоданные обновлены: [{$model->lat} {$model->lon}]");
    }

    protected function rules(Model $model = null)
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
