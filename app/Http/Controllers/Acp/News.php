<?php namespace App\Http\Controllers\Acp;

use App\Http\Requests\Acp\NewsCreate as ModelCreate;
use App\Http\Requests\Acp\NewsEdit as ModelEdit;
use App\News as Model;
use App\Notifications\NewsPublished;
use App\User;

class News extends Controller
{
    public function index()
    {
        $user_id = $this->request->input('user_id');

        $models = Model::withCount('comments')->orderBy('id', 'desc');

        if ($user_id) {
            $models = $models->where('user_id', $user_id);
        }

        $models = $models->paginate(20)
            ->appends(compact('user_id'));

        return view($this->view, compact('models', 'user_id'));
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

    public function notify(Model $model)
    {
        if ($model->status !== Model::STATUS_PUBLISHED) {
            return back()->with('message', 'Для рассылки уведомлений новость должна быть опубликована');
        }

        $users = User::forAnnouncement()->get();

        \Notification::send($users, new NewsPublished($model));

        return back()->with('message', 'Уведомления разосланы пользователям: '.sizeof($users));
    }

    public function show(Model $model)
    {
        return view($this->view, compact('model'));
    }

    public function store(ModelCreate $request)
    {
        $data = $request->all();
        $data['user_id'] = $this->request->user()->id;

        Model::create($data);

        return redirect()->action("{$this->class}@index");
    }

    public function update(Model $model, ModelEdit $request)
    {
        $model->update($request->all());

        return $this->redirectAfterUpdate($model);
    }
}
