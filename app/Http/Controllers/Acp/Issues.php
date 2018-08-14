<?php namespace App\Http\Controllers\Acp;

use App\Issue as Model;
use Illuminate\Database\Eloquent\Builder;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Issues extends Controller
{
    protected $api_only = true;
    protected $show_with = ['comments.user'];

    public function index()
    {
        $status = request('status');
        $user_id = request('user_id');

        [$sort_key, $sort_dir] = $this->getSortParams();

        $models = Model::with('user')
            ->withCount('comments')
            ->when($user_id, function (Builder $query) use ($user_id) {
                return $query->where('user_id', $user_id);
            })
            ->unless(null === $status, function (Builder $query) use ($status) {
                return $query->where('status', $status);
            })
            ->orderBy($sort_key, $sort_dir)
            ->paginate(50)
            ->withPath(path("{$this->class}@index"));

        return $this->modelResourceCollection($models);
    }

    public function batch()
    {
        $ids = request('selected', []);
        $action = request('action');

        $models = Model::find($ids);
        $message = '';
        $affected = 0;

        foreach ($models as $model) {
            /* @var Model $model */
            if ($action === 'close' && $model->canBeClosed()) {
                $model->status = Model::STATUS_CLOSED;
                $model->save();

                $affected++;
            } elseif ($action === 'delete') {
                if ($model->delete()) {
                    $affected++;
                }
            } elseif ($action === 'open' && $model->canBeOpened()) {
                $model->status = Model::STATUS_OPEN;
                $model->save();

                $affected++;
            }
        }

        switch ($action) {
            case 'open': $message = "Открыто обращений: {$affected}"; break;
            case 'close': $message = "Закрыто обращений: {$affected}"; break;
            case 'delete': $message = "Удалено записей: {$affected}"; break;
        }

        return [
            'status' => 'OK',
            'message' => $message,
        ];
    }
}
