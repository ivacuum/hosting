<?php namespace App\Http\Controllers\Acp;

use App\Server as Model;
use App\Http\Requests\Acp\ServerCreate as ModelCreate;
use App\Http\Requests\Acp\ServerEdit as ModelEdit;
use Breadcrumbs;

class Servers extends Controller
{
    const URL_PREFIX = 'acp/servers';

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
        Breadcrumbs::push($model->title, self::URL_PREFIX . "/{$model->id}");
        Breadcrumbs::push(trans($this->view));

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
        $input = $this->request->all();

        /* Сохранение ранее указанного пароля */
        $passwords = $this->request->only('ftp_pass');

        foreach ($passwords as $key => $value) {
            if (!$value) {
                unset($input[$key]);
            }
        }

        $model->update($input);

        $goto = $request->input('goto', '');

        if ($request->exists('_save')) {
            return $goto
                ? redirect()->action("{$this->class}@edit", [$model, 'goto' => $goto])
                : redirect()->action("{$this->class}@edit", $model);
        }

        return $goto ? redirect($goto) : redirect()->action("{$this->class}@index");
    }
}
