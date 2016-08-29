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
        $this->breadcrumbs();

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
        $this->breadcrumbs($model);

        return view($this->view, compact('model'));
    }

    public function show(Model $model)
    {
        $this->breadcrumbs($model);

        return view($this->view, compact('model'));
    }

    public function store(ModelCreate $request)
    {
        Model::create($request->all());

        return redirect()->action("{$this->class}@index");
    }

    public function update(Model $model, ModelEdit $request)
    {
        $model->update($request->all());

        $goto = $request->input('goto', '');

        if ($request->exists('_save')) {
            return $goto
                ? redirect()->action("{$this->class}@edit", [$model, 'goto' => $goto])
                : redirect()->action("{$this->class}@edit", $model);
        }

        return $goto ? redirect($goto) : redirect()->action("{$this->class}@index");
    }
}
