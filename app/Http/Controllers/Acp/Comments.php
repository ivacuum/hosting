<?php namespace App\Http\Controllers\Acp;

use App\Comment as Model;
use App\News;
use App\Torrent;
use App\Trip;
use Illuminate\Database\Eloquent\Builder;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Comments extends Controller
{
    public function index()
    {
        $status = request('status');
        $newsId = request('news_id');
        $tripId = request('trip_id');
        $userId = request('user_id');
        $torrentId = request('torrent_id');

        $models = Model::with('user')
            ->orderByDesc('id')
            ->when(null !== $status, fn (Builder $query) => $query->where('status', $status))
            ->when($newsId, fn (Builder $query) => $query->where('rel_id', $newsId)->where('rel_type', (new News)->getMorphClass()))
            ->when($tripId, fn (Builder $query) => $query->where('rel_id', $tripId)->where('rel_type', (new Trip)->getMorphClass()))
            ->when($torrentId, fn (Builder $query) => $query->where('rel_id', $torrentId)->where('rel_type', (new Torrent)->getMorphClass()))
            ->when($userId, fn (Builder $query) => $query->where('user_id', $userId))
            ->paginate(20)
            ->withPath(path([self::class, 'index']));

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
