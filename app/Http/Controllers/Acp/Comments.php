<?php namespace App\Http\Controllers\Acp;

use App\Comment as Model;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Comments extends Controller
{
    public function index()
    {
        $news_id = $this->request->input('news_id');
        $trip_id = $this->request->input('trip_id');
        $user_id = $this->request->input('user_id');
        $torrent_id = $this->request->input('torrent_id');

        $models = Model::with('user')->orderBy('id', 'desc');

        if ($news_id) {
            $models = $models->where('rel_id', $news_id)->where('rel_type', 'News');
        }
        if ($trip_id) {
            $models = $models->where('rel_id', $trip_id)->where('rel_type', 'Trip');
        }
        if ($user_id) {
            $models = $models->where('user_id', $user_id);
        }
        if ($torrent_id) {
            $models = $models->where('rel_id', $torrent_id)->where('rel_type', 'Torrent');
        }

        $models = $models->paginate(20)
            ->appends(compact('news_id', 'torrent_id', 'trip_id', 'user_id'));

        return view($this->view, compact('models', 'user_id'));
    }

    protected function rules($model = null)
    {
        return ['html' => 'required'];
    }
}
