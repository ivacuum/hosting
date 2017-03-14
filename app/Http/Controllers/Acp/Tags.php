<?php namespace App\Http\Controllers\Acp;

use App\Tag as Model;
use Illuminate\Validation\Rule;

class Tags extends Controller
{
    protected $title_attr = 'title_ru';

    public function index()
    {
        $models = Model::orderBy(Model::titleField())->get();

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
            'status' => 'OK',
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
            'title_ru' => [
                'required',
                Rule::unique('tags', 'title_ru')->ignore($model->id ?? null),
            ],
            'title_en' => [
                'required',
                Rule::unique('tags', 'title_en')->ignore($model->id ?? null),
            ],
        ];

        return $rules;
    }
}
