<?php namespace App\Http\Controllers\Acp;

use App\Comment as Model;
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
            ->when(null !== $status, function (Builder $query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($newsId, function (Builder $query) use ($newsId) {
                return $query->where('rel_id', $newsId)->where('rel_type', 'News');
            })
            ->when($tripId, function (Builder $query) use ($tripId) {
                return $query->where('rel_id', $tripId)->where('rel_type', 'Trip');
            })
            ->when($torrentId, function (Builder $query) use ($torrentId) {
                return $query->where('rel_id', $torrentId)->where('rel_type', 'Torrent');
            })
            ->when($userId, function (Builder $query) use ($userId) {
                return $query->where('user_id', $userId);
            })
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
