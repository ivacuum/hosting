<?php namespace App\Http\Controllers\Acp;

use App;
use App\City as Model;
use App\Http\Requests\Acp\CityCreate as ModelCreate;
use App\Http\Requests\Acp\CityEdit as ModelEdit;

class Cities extends Controller
{
    public function index()
    {
        $locale = App::getLocale();
        $models = Model::with('country')
            ->orderBy("title_{$locale}")
            ->get();

        return view($this->view, compact('models'));
    }

    public function create()
    {
        return view($this->view);
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
        return view($this->view, compact('model'));
    }

    public function show(Model $model)
    {
        return view($this->view, compact('model'));
    }

    public function store(ModelCreate $request)
    {
        Model::create($request->all());

        return redirect()->action("{$this->class}@index");
    }

    public function update(Model $model, ModelEdit $request)
    {
        $model->update($request->except('goto'));

        return $this->redirectAfterUpdate($model);
    }
}
