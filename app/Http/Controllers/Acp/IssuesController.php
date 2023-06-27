<?php

namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToShowAction;
use App\Domain\IssueStatus;
use App\Issue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class IssuesController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Issue::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        $sort = $applyIndexGoods->execute(new Issue);

        $status = request('status');
        $userId = request('user_id');

        $models = Issue::query()
            ->withCount('comments')
            ->when($userId, fn (Builder $query) => $query->where('user_id', $userId))
            ->unless(null === $status, fn (Builder $query) => $query->where('status', $status))
            ->orderBy(match ($sort->key) {
                'comments_count' => $sort->key,
                default => 'id',
            }, $sort->direction->value)
            ->paginate(50);

        return view('acp.issues.index', ['models' => $models]);
    }

    public function batch()
    {
        $ids = request('selected', []);
        $action = request('action');

        $models = Issue::find($ids);
        $affected = 0;

        foreach ($models as $model) {
            /** @var Issue $model */
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

    public function destroy(Issue $issue, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($issue);
    }

    public function show(Issue $issue, ResponseToShowAction $responseToShow)
    {
        $issue->load('comments.user');

        return $responseToShow->execute($issue, ['comments']);
    }
}
