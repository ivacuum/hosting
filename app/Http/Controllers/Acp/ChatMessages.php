<?php namespace App\Http\Controllers\Acp;

use App\ChatMessage as Model;
use Illuminate\Database\Eloquent\Builder;
use Ivacuum\Generic\Controllers\Acp\Controller;

class ChatMessages extends Controller
{
    public function index()
    {
        $status = request('status');
        $user_id = request('user_id');

        $models = Model::with('user')
            ->orderBy('id', 'desc')
            ->unless(is_null($status), function (Builder $query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($user_id, function (Builder $query) use ($user_id) {
                return $query->where('user_id', $user_id);
            })
            ->paginate();

        return view($this->view, compact('models', 'status', 'user_id'));
    }

    public function batch()
    {
        $ids = request('ids');
        $action = request('action');

        $models = Model::find($ids);

        foreach ($models as $model) {
            /* @var Model $model */
            if ($action === 'delete') {
                $model->delete();
            } elseif ($action === 'hide') {
                $model->status = Model::STATUS_HIDDEN;
                $model->save();
            } elseif ($action === 'publish') {
                $model->status = Model::STATUS_PUBLISHED;
                $model->save();
            }
        }

        return $this->redirectAfterDestroy(new Model);
    }

    protected function rules($model = null)
    {
        return [
            'text' => 'required',
            'status' => 'required',
        ];
    }
}
