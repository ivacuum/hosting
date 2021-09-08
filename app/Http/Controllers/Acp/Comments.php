<?php namespace App\Http\Controllers\Acp;

use App\Comment as Model;
use App\Issue;
use App\News;
use App\Torrent;
use App\Trip;
use Illuminate\Database\Eloquent\Builder;

class Comments extends AbstractController
{
    public function index()
    {
        $status = request('status');
        $newsId = request('news_id');
        $tripId = request('trip_id');
        $userId = request('user_id');
        $issueId = request('issue_id');
        $torrentId = request('torrent_id');

        $models = Model::query()
            ->with('user')
            ->when(null !== $status, fn (Builder $query) => $query->where('status', $status))
            ->when($issueId, fn (Builder $query) => $query->where('rel_type', (new Issue)->getMorphClass())->where('rel_id', $issueId))
            ->when($newsId, fn (Builder $query) => $query->where('rel_type', (new News)->getMorphClass())->where('rel_id', $newsId))
            ->when($tripId, fn (Builder $query) => $query->where('rel_type', (new Trip)->getMorphClass())->where('rel_id', $tripId))
            ->when($torrentId, fn (Builder $query) => $query->where('rel_type', (new Torrent)->getMorphClass())->where('rel_id', $torrentId))
            ->when($userId, fn (Builder $query) => $query->where('user_id', $userId))
            ->orderByDesc('id')
            ->paginate(20);

        return view($this->view, [
            'models' => $models,
            'status' => $status,
            'user_id' => $userId,
        ]);
    }

    protected function rules($model = null)
    {
        return ['html' => 'required'];
    }
}
