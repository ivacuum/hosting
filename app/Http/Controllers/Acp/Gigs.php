<?php namespace App\Http\Controllers\Acp;

use App\Gig as Model;
use App\Http\Requests\Acp\GigCreate as ModelCreate;
use App\Http\Requests\Acp\GigEdit as ModelEdit;

class Gigs extends Controller
{
    public function index()
    {
        $models = Model::orderBy('date', 'desc')->get();

        return view($this->view, compact('models'));
    }

    public function create()
    {
        $this->appendTemplates();

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
        $this->appendTemplates();

        return view('acp.edit', compact('model'));
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

    protected function appendTemplates()
    {
        $templates = [];

        foreach (glob(base_path('resources/views/life/gigs/*.blade.php')) as $template) {
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
