<?php namespace App\Http\Controllers\Acp;

use App\Comment as Model;
use Illuminate\Database\Eloquent\Builder;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Comments extends Controller
{
    public function index()
    {
        $status = $this->request->input('status');
        $news_id = $this->request->input('news_id');
        $trip_id = $this->request->input('trip_id');
        $user_id = $this->request->input('user_id');
        $torrent_id = $this->request->input('torrent_id');

        $models = Model::with('user')
            ->orderBy('id', 'desc')
            ->when(!is_null($status), function (Builder $query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($news_id, function (Builder $query) use ($news_id) {
                return $query->where('rel_id', $news_id)->where('rel_type', 'News');
            })
            ->when($trip_id, function (Builder $query) use ($trip_id) {
                return $query->where('rel_id', $trip_id)->where('rel_type', 'Trip');
            })
            ->when($torrent_id, function (Builder $query) use ($torrent_id) {
                return $query->where('rel_id', $torrent_id)->where('rel_type', 'Torrent');
            })
            ->when($user_id, function (Builder $query) use ($user_id) {
                return $query->where('user_id', $user_id);
            })
            ->paginate(20);

        return view($this->view, compact('models', 'status', 'user_id'));
    }

    protected function rules($model = null)
    {
        return ['html' => 'required'];
    }
}
