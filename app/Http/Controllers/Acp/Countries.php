<?php namespace App\Http\Controllers\Acp;

use App;
use App\Country as Model;
use App\Http\Requests\Acp\CountryCreate as ModelCreate;
use App\Http\Requests\Acp\CountryEdit as ModelEdit;

class Countries extends Controller
{
    public function index()
    {
        $locale = App::getLocale();
        $models = Model::orderBy("title_{$locale}")->get();

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

    public function store(ModelCreate $request)
    {
        Model::create($request->all());

        return redirect()->action("{$this->class}@index");
    }

    public function update(Model $model, ModelEdit $request)
    {
        $model->update($request->all());

        return $this->redirectAfterUpdate($model);
    }
}
