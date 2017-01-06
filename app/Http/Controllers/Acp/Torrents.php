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

        $models = Model::with('user')->orderBy('id', 'desc');

        if ($user_id) {
            $models = $models->where('user_id', $user_id);
        }

        $models = $models->paginate()
            ->appends(compact('user_id'));

        return view($this->view, compact('models', 'user_id'));
    }

    public function create()
    {
        return view($this->view);
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

    public function store(ModelCreate $request)
    {
        Model::create($request->all());

        return redirect()->action("{$this->class}@index");
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

        $model->update([
            'html' => $data['body'],
            'size' => $data['size'],
            'title' => $data['title'],
            'clicks' => 0,
            'seeders' => $data['seeders'],
            'info_hash' => $data['info_hash'],
            'announcer' => $data['announcer'],
            'registered_at' => Carbon::createFromTimestamp($data['reg_time']),
        ]);

        return redirect()->action("{$this->class}@show", $model)
            ->with('message', 'Раздача обновлена');
    }
}
