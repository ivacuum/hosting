<?php namespace App\Http\Controllers\Acp;

use App\News as Model;
use App\Notifications\NewsPublished;
use App\User;

class News extends CommonController
{
    protected $show_with_count = ['comments'];

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

    public function notify($id)
    {
        $model = $this->getModel($id);

        if ($model->status !== Model::STATUS_PUBLISHED) {
            return back()->with('message', 'Для рассылки уведомлений новость должна быть опубликована');
        }

        $users = User::forAnnouncement()->get();

        \Notification::send($users, new NewsPublished($model));

        return back()->with('message', 'Уведомления разосланы пользователям: '.sizeof($users));
    }

    protected function rules($model = null)
    {
        return [
            'html' => 'required',
            'title' => 'required',
            'site_id' => 'required|integer|min:1',
        ];
    }

    protected function storeModel()
    {
        $data = $this->request->all();
        $data['user_id'] = $this->request->user()->id;

        $model = Model::create($data);

        return $model;
    }
}
