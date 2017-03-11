<?php namespace App\Http\Controllers\Acp;

use App\Http\Requests\Acp\TripCreate as ModelCreate;
use App\Http\Requests\Acp\TripEdit as ModelEdit;
use App\Notifications\TripPublished;
use App\Trip as Model;
use App\User;

class Trips extends Controller
{
    public function index()
    {
        $models = Model::withCount('comments')->orderBy('date_start', 'desc')->get();

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
        return view($this->view, compact('model'));
    }

    public function notify(Model $model)
    {
        if ($model->status !== Model::STATUS_PUBLISHED) {
            return back()->with('message', 'Для рассылки уведомлений поездка должна быть опубликована');
        }

        $users = User::forAnnouncement()->get();

        \Notification::send($users, new TripPublished($model));

        return back()->with('message', 'Уведомления разосланы пользователям: '.sizeof($users));
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
}
