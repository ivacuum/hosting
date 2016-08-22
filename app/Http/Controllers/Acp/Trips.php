<?php namespace App\Http\Controllers\Acp;

use App\Http\Requests\Acp\TripCreate as ModelCreate;
use App\Http\Requests\Acp\TripEdit as ModelEdit;
use App\Trip as Model;
use Breadcrumbs;

class Trips extends Controller
{
    const URL_PREFIX = 'acp/trips';

    public function __construct()
    {
        parent::__construct();

        Breadcrumbs::push(trans("{$this->prefix}.index"), self::URL_PREFIX);
    }

    public function index()
    {
        $models = Model::orderBy('date_start', 'desc')->get();

        return view($this->view, compact('models'));
    }

    public function create()
    {
        Breadcrumbs::push(trans($this->view));

        $this->appendTemplates();

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
        Breadcrumbs::push($model->title, self::URL_PREFIX . "/{$model->id}");
        Breadcrumbs::push(trans($this->view));

        $this->appendTemplates();

        return view($this->view, compact('model'));
    }

    public function show(Model $model)
    {
        Breadcrumbs::push($model->title);

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

    protected function appendTemplates()
    {
        $templates = [];

        foreach (glob(base_path('resources/views/life/trips/*.blade.php')) as $template) {
            $info = pathinfo($template);
            $filename = str_replace('.blade.php', '', $info['basename']);

            if ($filename == 'base') {
                continue;
            }

            $templates[] = $filename;
        }

        view()->share(compact('templates'));
    }
}
