<?php namespace App\Http\Controllers\Acp;

use App\Services\Rto;
use App\Torrent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Torrents extends Controller
{
    protected $sortable_keys = ['id', 'views', 'comments_count', 'clicks'];
    protected $show_with_count = ['comments'];

    public function index()
    {
        $status = request('status');
        $user_id = request('user_id');

        [$sort_key, $sort_dir] = $this->getSortParams();

        $models = Model::with('user')
            ->withCount('comments')
            ->orderBy($sort_key, $sort_dir)
            ->when(!is_null($status), function (Builder $query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($user_id, function (Builder $query) use ($user_id) {
                return $query->where('user_id', $user_id);
            })
            ->paginate();

        return view($this->view, compact('models', 'status', 'user_id'));
    }

    public function updateRto($id, Rto $rto)
    {
        /* @var Model $model */
        $model = $this->getModel($id);

        if (!is_array($data = $rto->torrentData($model->rto_id))) {
            return back()->with('message', 'Не удалось обновить информацию о раздаче');
        }

        $reg_time = Carbon::createFromTimestamp($data['reg_time']);
        $registered_at = $reg_time->gt($model->registered_at) ? now() : $model->registered_at;

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
            'rto_id' => [
                'required',
                Rule::unique('torrents', 'rto_id')->ignore($model->id ?? null),
            ],
        ];
    }
}
