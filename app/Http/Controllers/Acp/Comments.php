<?php namespace App\Http\Controllers\Acp;

use App\Comment as Model;
use App\Http\Requests\Acp\CommentEdit as ModelEdit;

class Comments extends Controller
{
    protected $title_attr = 'id';

    public function index()
    {
        $rel = $this->request->input('rel');
        $rel_id = $this->request->input('rel_id');
        $user_id = $this->request->input('user_id');

        $models = Model::with('user')->orderBy('id', 'desc');

        if ($rel && $rel_id) {
            $models = $models->where('rel_id', $rel_id)
                ->where('rel_type', $rel);
        }
        if ($user_id) {
            $models = $models->where('user_id', $user_id);
        }

        $models = $models->paginate(20)
            ->appends(compact('rel', 'rel_id', 'user_id'));

        return view($this->view, compact('models', 'user_id'));
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
        return view($this->view, compact('model'));
    }

    public function update(Model $model, ModelEdit $request)
    {
        $model->update($request->all());

        return $this->redirectAfterUpdate($model);
    }
}
