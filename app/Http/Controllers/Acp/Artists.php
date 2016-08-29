<?php namespace App\Http\Controllers\Acp;

use App\Artist as Model;
use App\Http\Requests\Acp\ArtistCreate as ModelCreate;
use App\Http\Requests\Acp\ArtistEdit as ModelEdit;

class Artists extends Controller
{
    protected $breadcrumbs_prefix = 'acp/artists';

    public function index()
    {
        $models = Model::orderBy('title', 'asc')->get();

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
