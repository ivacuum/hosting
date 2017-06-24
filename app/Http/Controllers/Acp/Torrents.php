<?php namespace App\Http\Controllers\Acp;

use App\Services\Rto;
use App\Torrent as Model;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Torrents extends Controller
{
    protected $show_with_count = ['comments'];

    public function index()
    {
        $user_id = $this->request->input('user_id');

        $models = Model::with('user')->withCount('comments')->orderBy('id', 'desc');

        if ($user_id) {
            $models = $models->where('user_id', $user_id);
        }

        $models = $models->paginate()
            ->appends(\UrlHelper::except());

        return view($this->view, compact('models', 'user_id'));
    }

    public function updateRto($id, Rto $rto)
    {
        $model = $this->getModel($id);

        if (!is_array($data = $rto->torrentData($model->rto_id))) {
            return back()->with('message', 'Не удалось обновить информацию о раздаче');
        }

        $reg_time = Carbon::createFromTimestamp($data['reg_time']);
        $registered_at = $reg_time->gt($model->registered_at) ? Carbon::now() : $model->registered_at;

        $model->update([
            'html' => $data['body'],
            'size' => $data['size'],
            'title' => $data['title'],
            'seeders' => $data['seeders'],
            'info_hash' => $data['info_hash'],
            'announcer' => $data['announcer'],
            'registered_at' => $registered_at,
        ]);

        return redirect(path("{$this->class}@show", $model))
            ->with('message', 'Раздача обновлена');
    }

    /**
     * @param  Model|null $model
     * @return array
     */
    protected function rules($model = null)
    {
        return [
            'html' => 'required',
            'title' => 'required',
            'rto_id' => [
                'required',
                Rule::unique('torrents', 'rto_id')->ignore($model->id ?? null),
            ],
            'info_hash' => 'required',
        ];
    }
}
