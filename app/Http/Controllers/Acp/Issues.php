<?php namespace App\Http\Controllers\Acp;

use App\Issue as Model;
use Illuminate\Database\Eloquent\Builder;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Issues extends Controller
{
    protected $showWith = ['comments.user'];
    protected $sortableKeys = ['id', 'comments_count'];
    protected $showWithCount = ['comments'];

    public function index()
    {
        $status = request('status');
        $userId = request('user_id');

        [$sortKey, $sortDir] = $this->getSortParams();

        $models = Model::query()
            ->withCount('comments')
            ->when($userId, fn (Builder $query) => $query->where('user_id', $userId))
            ->unless(null === $status, fn (Builder $query) => $query->where('status', $status))
            ->orderBy($sortKey, $sortDir)
            ->paginate(50);

        return view($this->view, [
            'models' => $models,
        ]);
    }

    public function batch()
    {
        $ids = request('selected', []);
        $action = request('action');

        $models = Model::find($ids);
        $message = '';
        $affected = 0;

        foreach ($models as $model) {
            /** @var Model $model */
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
