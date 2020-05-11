<?php namespace App\Http\Controllers\Acp;

use App\News as Model;
use App\Notifications\NewsPublishedNotification;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class News extends AbstractController
{
    protected $sortableKeys = ['id', 'views', 'comments_count'];
    protected $showWithCount = ['comments'];

    public function index()
    {
        $userId = request('user_id');

        $models = Model::query()
            ->withCount('comments')
            ->when($userId, fn (Builder $query) => $query->where('user_id', $userId))
            ->where('locale', \App::getLocale())
            ->orderBy($this->getSortKey(), $this->getSortDir())
            ->paginate(20);

        return view($this->view, [
            'models' => $models,
            'user_id' => $userId,
        ]);
    }

    public function notify($id)
    {
        /** @var Model $model */
        $model = $this->getModel($id);

        if ($model->status !== Model::STATUS_PUBLISHED) {
            return back()->with('message', 'Для рассылки уведомлений новость должна быть опубликована');
        }

        $users = User::where('notify_news', 1)
            ->where('status', User::STATUS_ACTIVE)
            ->where('locale', $model->locale)
            ->get();

        \Notification::send($users, new NewsPublishedNotification($model));

        return back()->with('message', 'Уведомления разосланы пользователям: '.sizeof($users));
    }

    protected function rules($model = null)
    {
        return [
            'title' => 'required',
            'markdown' => 'required',
        ];
    }

    protected function storeModel()
    {
        $data = $this->requestDataForModel();
        $data['locale'] = \App::getLocale();
        $data['user_id'] = request()->user()->id;

        $model = Model::create($data);

        return $model;
    }
}
