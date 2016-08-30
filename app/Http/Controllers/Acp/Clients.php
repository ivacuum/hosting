<?php namespace App\Http\Controllers\Acp;

use App\Client as Model;
use App\Http\Requests\Acp\ClientCreate as ModelCreate;
use App\Http\Requests\Acp\ClientEdit as ModelEdit;

class Clients extends Controller
{
    protected $title_attr = 'name';

    public function index()
    {
        $models = Model::get();

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
        $filter = '';
        $q = $this->request->input('q');

        $domains = $model->domains()->orderBy('paid_till');

        if ($q) {
            $domains = $domains->where('domain', 'LIKE', "%{$q}%");
        }

        $model->domains = $domains->paginate()
            ->appends(compact('q'));

        return view($this->view, compact('filter', 'model', 'q'));
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
