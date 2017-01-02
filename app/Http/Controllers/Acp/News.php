<?php namespace App\Http\Controllers\Acp;

use App\Http\Requests\Acp\NewsCreate as ModelCreate;
use App\Http\Requests\Acp\NewsEdit as ModelEdit;
use App\News as Model;

class News extends Controller
{
    public function index()
    {
        $models = Model::orderBy('id', 'desc')->paginate(20);

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
        $model->update($request->all());

        return $this->redirectAfterUpdate($model);
    }
}
