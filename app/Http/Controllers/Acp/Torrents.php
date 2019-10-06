<?php namespace App\Http\Controllers\Acp;

use App\Services\Rto;
use App\Torrent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Torrents extends Controller
{
    protected $sortableKeys = ['id', 'views', 'comments_count', 'clicks'];
    protected $showWithCount = ['comments'];

    public function index()
    {
        $q = request('q');
        $status = request('status');
        $userId = request('user_id');

        [$sortKey, $sortDir] = $this->getSortParams();

        $models = Model::with('user')
            ->withCount('comments')
            ->orderBy($sortKey, $sortDir)
            ->when(null !== $status, function (Builder $query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($userId, function (Builder $query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when($q, function (Builder $query) use ($q) {
                return $query->where('title', 'LIKE', "%{$q}%");
            })
            ->paginate()
            ->withPath(path([$this->controller, 'index']));

        return view($this->view, [
            'models' => $models,
            'status' => $status,
            'user_id' => $userId,
        ]);
    }

    public function updateRto($id, Rto $rto)
    {
        /** @var Model $model */
        $model = $this->getModel($id);

        if (!is_array($data = $rto->torrentData($model->rto_id))) {
            return back()->with('message', 'Не удалось обновить информацию о раздаче');
        }

        $regTime = Carbon::createFromTimestamp($data['reg_time']);
        $registeredAt = $regTime->gt($model->registered_at) ? now() : $model->registered_at;

        $model->update([
            'html' => $data['body'],
            'size' => $data['size'],
            'title' => $data['title'],
            'info_hash' => $data['info_hash'],
            'announcer' => $data['announcer'],
            'registered_at' => $registeredAt,
        ]);

        return redirect(path([$this->controller, 'show'], $model))
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
            'category_id' => 'required|integer|min:1',
        ];
    }
}
