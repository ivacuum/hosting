<?php namespace App\Http\Controllers\Acp;

use App\Domain\MagnetStatus;
use App\Magnet as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class Magnets extends AbstractController
{
    protected $sortableKeys = ['id', 'views', 'comments_count', 'clicks'];
    protected $showWithCount = ['comments'];

    public function index()
    {
        $q = request('q');
        $status = request('status');
        $userId = request('user_id');

        $models = Model::query()
            ->with('user')
            ->withCount('comments')
            ->when(null !== $status, fn (Builder $query) => $query->where('status', MagnetStatus::from($status)))
            ->when($userId, fn (Builder $query) => $query->where('user_id', $userId))
            ->when($q, fn (Builder $query) => $query->where('title', 'LIKE', "%{$q}%"))
            ->orderBy($this->getSortKey(), $this->getSortDir())
            ->paginate();

        return view($this->view, [
            'models' => $models,
            'status' => $status,
            'user_id' => $userId,
        ]);
    }

    /**
     * @param Model|null $model
     * @return array
     */
    protected function rules($model = null)
    {
        return [
            'rto_id' => [
                'required',
                Rule::unique('torrents', 'rto_id')->ignore($model->id ?? null),
            ],
            'status' => new Enum(MagnetStatus::class),
            'category_id' => 'required|integer|min:1',
        ];
    }
}
