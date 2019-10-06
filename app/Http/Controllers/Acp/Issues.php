<?php namespace App\Http\Controllers\Acp;

use App\Issue as Model;
use Illuminate\Database\Eloquent\Builder;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Issues extends Controller
{
    protected $apiOnly = true;
    protected $showWith = ['comments.user'];

    public function index()
    {
        $status = request('status');
        $userId = request('user_id');

        [$sortKey, $sortDir] = $this->getSortParams();

        $models = Model::with('user')
            ->withCount('comments')
            ->when($userId, function (Builder $query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->unless(null === $status, function (Builder $query) use ($status) {
                return $query->where('status', $status);
            })
            ->orderBy($sortKey, $sortDir)
            ->paginate(50)
            ->withPath(path([self::class, 'index']));

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
