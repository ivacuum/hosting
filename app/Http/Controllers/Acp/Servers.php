<?php namespace App\Http\Controllers\Acp;

use App\Server as Model;
use App\Http\Requests\Acp\ServerCreate as ModelCreate;
use App\Http\Requests\Acp\ServerEdit as ModelEdit;

class Servers extends Controller
{
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
