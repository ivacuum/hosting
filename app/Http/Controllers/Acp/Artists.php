<?php namespace App\Http\Controllers\Acp;

use App\Artist as Model;
use Illuminate\Validation\Rule;

class Artists extends Controller
{
    public function index()
    {
        $models = Model::orderBy('title')->get();

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

    public function store()
    {
        $this->validate($this->request, $this->rules());

        Model::create($this->request->all());

        return redirect()->action("{$this->class}@index");
    }

    public function update(Model $model)
    {
        $this->validate($this->request, $this->rules($model));

        $model->update($this->request->all());

        return $this->redirectAfterUpdate($model);
    }

    protected function rules(Model $model = null)
    {
        $rules = [
            'slug' => [
                'bail',
                'required',
                Rule::unique('artists', 'slug')->ignore($model->id ?? null),
                Rule::unique('cities', 'slug')->ignore($model->id ?? null),
                Rule::unique('gigs', 'slug')->ignore($model->id ?? null),
                Rule::unique('trips', 'slug')->ignore($model->id ?? null),
            ],
            'title' => 'required',
        ];

        return $rules;
    }
}
