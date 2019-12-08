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
            ->withPath(path([self::class, 'index']));

        return view($this->view, [
            'models' => $models,
            'status' => $status,
            'user_id' => $userId,
        ]);
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
