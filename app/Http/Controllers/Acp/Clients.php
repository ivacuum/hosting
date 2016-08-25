<?php namespace App\Http\Controllers\Acp;

use App\Client as Model;
use App\Http\Requests\Acp\ClientCreate as ModelCreate;
use App\Http\Requests\Acp\ClientEdit as ModelEdit;
use Breadcrumbs;

class Clients extends Controller
{
    const URL_PREFIX = 'acp/clients';

    public function __construct()
    {
        parent::__construct();

        Breadcrumbs::push(trans("{$this->prefix}.index"), self::URL_PREFIX);
    }

    public function index()
    {
        $models = Model::get();

        return view($this->view, compact('models'));
    }

    public function create()
    {
        Breadcrumbs::push(trans($this->view));

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
        Breadcrumbs::push($model->name, self::URL_PREFIX . "/{$model->id}");
        Breadcrumbs::push(trans($this->view));

        return view($this->view, compact('model'));
    }

    public function show(Model $model)
    {
        Breadcrumbs::push($model->name);

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
