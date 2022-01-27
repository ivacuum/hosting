<?php namespace App\Http\Controllers\Acp;

use App\Domain\IssueStatus;
use App\Issue as Model;
use Illuminate\Database\Eloquent\Builder;

class Issues extends AbstractController
{
    protected $showWith = ['comments.user'];
    protected $sortableKeys = ['id', 'comments_count'];
    protected $showWithCount = ['comments'];

    public function index()
    {
        $status = request('status');
        $userId = request('user_id');

        $models = Model::query()
            ->withCount('comments')
            ->when($userId, fn (Builder $query) => $query->where('user_id', $userId))
            ->unless(null === $status, fn (Builder $query) => $query->where('status', IssueStatus::from($status)))
            ->orderBy($this->getSortKey(), $this->getSortDir())
            ->paginate(50);

        return view($this->view, ['models' => $models]);
    }

    public function batch()
    {
        $ids = request('selected', []);
        $action = request('action');

        $models = Model::find($ids);
        $affected = 0;

        foreach ($models as $model) {
            /** @var Model $model */
            if ($action === 'close' && $model->canBeClosed()) {
                $model->status = IssueStatus::Closed;
                $model->save();

                $affected++;
            } elseif ($action === 'delete') {
                if ($model->delete()) {
                    $affected++;
                }
            } elseif ($action === 'open' && $model->canBeOpened()) {
                $model->status = IssueStatus::Open;
                $model->save();

                $affected++;
            }
        }

        $message = match ($action) {
            'open' => "Открыто обращений: {$affected}",
            'close' => "Закрыто обращений: {$affected}",
            'delete' => "Удалено записей: {$affected}",
        };

        return [
            'status' => 'OK',
            'message' => $message,
        ];
    }
}
