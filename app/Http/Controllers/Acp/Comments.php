<?php namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToEditAction;
use App\Action\Acp\ResponseToShowAction;
use App\Comment;
use App\Issue;
use App\Magnet;
use App\News;
use App\Trip;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class Comments extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Comment::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        [$sortKey, $sortDir] = $applyIndexGoods->execute(new Comment);

        $status = request('status');
        $newsId = request('news_id');
        $tripId = request('trip_id');
        $userId = request('user_id');
        $issueId = request('issue_id');
        $magnetId = request('magnet_id');

        $models = Comment::query()
            ->with('user')
            ->when(null !== $status, fn (Builder $query) => $query->where('status', $status))
            ->when($issueId, fn (Builder $query) => $query->where('rel_type', (new Issue)->getMorphClass())->where('rel_id', $issueId))
            ->when($newsId, fn (Builder $query) => $query->where('rel_type', (new News)->getMorphClass())->where('rel_id', $newsId))
            ->when($tripId, fn (Builder $query) => $query->where('rel_type', (new Trip)->getMorphClass())->where('rel_id', $tripId))
            ->when($magnetId, fn (Builder $query) => $query->where('rel_type', (new Magnet)->getMorphClass())->where('rel_id', $magnetId))
            ->when($userId, fn (Builder $query) => $query->where('user_id', $userId))
            ->orderBy($sortKey, $sortDir)
            ->paginate(20);

        return view('acp.comments.index', [
            'models' => $models,
            'status' => $status,
            'user_id' => $userId,
        ]);
    }

    public function destroy(Comment $comment, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($comment);
    }

    public function edit(Comment $comment, ResponseToEditAction $responseToEdit)
    {
        return $responseToEdit->execute($comment);
    }

    public function show(Comment $comment, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($comment);
    }
}
