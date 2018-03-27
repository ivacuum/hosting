<?php namespace App\Http\Controllers\Acp;

use App\News as Model;
use App\Notifications\NewsPublished;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Ivacuum\Generic\Controllers\Acp\Controller;

class News extends Controller
{
    protected $sortable_keys = ['id', 'views', 'comments_count'];
    protected $show_with_count = ['comments'];

    public function index()
    {
        $user_id = request('user_id');

        [$sort_key, $sort_dir] = $this->getSortParams();

        $models = Model::withCount('comments')
            ->orderBy($sort_key, $sort_dir)
            ->when($user_id, function (Builder $query) use ($user_id) {
                return $query->where('user_id', $user_id);
            })
            ->paginate(20)
            ->withPath(path("{$this->class}@index"));

        return view($this->view, compact('models', 'user_id'));
    }

    public function notify($id)
    {
        /* @var Model $model */
        $model = $this->getModel($id);

        if ($model->status !== Model::STATUS_PUBLISHED) {
            return back()->with('message', 'Для рассылки уведомлений новость должна быть опубликована');
        }

        $users = User::where('notify_news', 1)
            ->where('locale', $model->locale)
            ->get();

        \Notification::send($users, new NewsPublished($model));

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
