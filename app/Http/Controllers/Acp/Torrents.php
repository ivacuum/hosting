<?php namespace App\Http\Controllers\Acp;

use App\Services\Rto;
use App\Torrent as Model;
use App\Http\Requests\Acp\TorrentCreate as ModelCreate;
use App\Http\Requests\Acp\TorrentEdit as ModelEdit;
use Carbon\Carbon;

class Torrents extends Controller
{
    public function index()
    {
        $user_id = $this->request->input('user_id');

        $models = Model::with('user')->withCount('comments')->orderBy('id', 'desc');

        if ($user_id) {
            $models = $models->where('user_id', $user_id);
        }

        $models = $models->paginate()
            ->appends(compact('user_id'));

        return view($this->view, compact('models', 'user_id'));
    }

    public function destroy(Model $model)
    {
        $model->delete();

        return [
            'status'   => 'OK',
            'redirect' => action("{$this->class}@index"),
        ];
    }

    public function edit(Model $model)
    {
        return view($this->view, compact('model'));
    }

    public function show(Model $model)
    {
        return view($this->view, compact('model'));
    }

    public function update(Model $model, ModelEdit $request)
    {
        $model->update($request->all());

        return $this->redirectAfterUpdate($model);
    }

    public function updateRto(Model $model, Rto $rto)
    {
        if (!is_array($data = $rto->torrentData($model->rto_id))) {
            return back()->with('message', 'Не удалось обновить информацию о раздаче');
        }

        $reg_time = Carbon::createFromTimestamp($data['reg_time']);
        $registered_at = $reg_time->gt($model->registered_at) ? Carbon::now() : $model->registered_at;

        $model->update([
            'html' => $data['body'],
            'size' => $data['size'],
            'title' => $data['title'],
            'clicks' => 0,
            'seeders' => $data['seeders'],
            'info_hash' => $data['info_hash'],
            'announcer' => $data['announcer'],
            'registered_at' => $registered_at,
        ]);

        return redirect()->action("{$this->class}@show", $model)
            ->with('message', 'Раздача обновлена');
    }
}
